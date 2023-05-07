<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
	public function getAll(){
		return Product::all();
	}

	
	
	public function index($olddata=NULL)
	{
		$product = DB::table('products')
			->join('categories', 'products.category_id', '=', 'categories.id')
			->select('products.*', 'categories.name as category_name')
			->paginate(8);

		$newdata = ([
			'shipping_methods' => DB::table('shipping')->get(),
			'collection' =>  $product,
			'categories' => AdminCategoryController::getLeafs()
		]);
		if($olddata!=NULL) 
			$data = array_merge($olddata,$newdata);
		else 
			$data = $newdata;
		return view('admin.manager.product.index', $data);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string:255',
			'categoryid' => 'required|integer|min:1',
			'detail' => 'max:2000000000',
			'weight' => 'required',
		],[
			'categoryid.min' => trans('admin.product.message.categorymustbeavavlidvalue'),
		]);

		
		$product= new Product();
		$product->timestamps = false;

		$product->status = ($request->has('status'))?('ACTIVE'):('INACTIVE');
		$product->name = $request->name;
		$product->category_id = $request->categoryid;
		$product->weight = ($request->weight!=NULL)?($request->weight):0;
		$product->stock = ($request->stock!=NULL)?($request->stock):0;
		$product->price = ($request->price!=NULL)?($request->price):0;
		$product->saleoff_price = ($request->saleoffprice!=NULL)?($request->saleoffprice):0;
		$product->detail = ($request->detail!=NULL)?$request->detail:"";
		$product->images = '';
		
		if(json_decode($request->images)!=NULL){
			$product->images =$request->images;
		} else {
			$product->images ="";
		}
		
		$product->save();

		// Classify Product here
		$options = [];
		if(strlen($request->options) > 2) {
			try {
				$product->stock = 0;
				$options_arr = json_decode($request->options);
				foreach((array)$options_arr as $option){
					$options_name = $option->name;
					foreach($option->values as $item){
						$product->price = ($product->price < $item->price)?($product->price):($item->price);
						$product->stock += $item->stock;
						array_push($options , [
							'product_id' => $product->id,
							'name' => $options_name,
							'value' => $item->name,
							'price' => $item->price,
							'stock' => $item->stock
						]);
					}
				}
				DB::table('productclassifications')->insert($options);
				$product->classified = 1;
				$product->saleoff_price = 0;
				$product->save();
			} catch (\Error $e) {
				return back()->withInput()->withErrors(['warning'=>trans('admin.product.message.errorwhileaddingcassification').$e->getMessage()]);
			}
			
		} else {
			$product->classified = 0;
		}
		
		// Shipping method here
		if($request->has('shippingmethods')){
			foreach($request->shippingmethods as $shippingmethod){
				try {
					$shippingmethod_id = DB::table('shipping')->where('code','=',$shippingmethod)->first()->id;
					DB::table('productshippingmethods')->updateOrInsert([
						'product_id' => $product->id,
						'shipping_id' => $shippingmethod_id
					]);
				} catch (\Exception $e) {
					return back()->withInput()->withErrors(['warning'=>trans('admin.product.message.errorwhileaddingshippingmethod').$e->getMessage()]);
				}
			};
		}
		
		
		return redirect()->back()->withErrors(['success'=> trans('admin.product.message.productadded')]);
	}

	public function update(Request $request,$p)
	{
		// find object
		$product = Product::find($p);

		// create Product object and append data:
		// disable timestamp adding:
		$product->timestamps = false;

		//affect count
		$prop = 0;

		if($request->name != $product->name){
			// validate NAME
			$this->validate($request, [
				'name' => 'required|string:255',
			]);
			$product->name = $request->name;
			$prop ++;
		}

		if($request->price != $product->price){
			$this->validate($request, [
				'price' => 'required|min:0',
			]);
			$product->price = $request->price;
			$prop ++;
		}

		if($request->detail != $product->detail){
			$this->validate($request, [
				'detail', 'string|max:2000000000',
			]);
			$product->detail = $request->detail;
			$prop ++;
		}
		
		if($request->has('status')){
			$prop ++;
			$product->status = 'ACTIVE';
		} else {
			$prop ++;
			$product->status = 'INACTIVE';
		}

		if($request->saleoffprice != $product->saleoff_price){
			$product->saleoff_price = $request->saleoffprice;
			$prop ++;
		}
		
		if($request->weight != $product->weight){
			$product->weight = $request->weight;
			$prop ++;
		}

		if($request->stock != $product->stock){
			$product->stock = $request->stock;
			$prop ++;
		}
		
		error_log($request->images . ">>" . $product->images);
		if($request->images!=$product->images){
			$product->images =$request->images;
			$prop ++;
		} 


		if($prop)$product->save();
		return redirect()->route('admin.product')->withErrors(['success' => $prop.' thuộc tính đã thay đổi.']);
	}

	public function destroy($p)
	{
		$product = Product::find($p);
		
		// delete images
		if($product->images != ""){
			$files = array_filter(
				glob(
					storage_path(
						'app/public/products/'.$product->id.'/*'
					)
				),
				"is_file"
			);
			foreach($files as $file) unlink($file); // delete files

			rmdir(storage_path(
				'app/public/products/'.$product->id
			));
		}
		// return view('tested', ['msg'=>$product]);
		// delete record from database
		$product->delete();
		unset($product);
		return redirect()->route('admin.product')->withErrors(['success' => 'Đã xóa 1 SP']);
	}


	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}

	/**
	 * cập nhật lại số lượng sản phẩm khi có thay đổi về đơn hàng
	 * @param int $id mã sản phẩm
	 * @param int $quantity số lượng sản phẩm cần thay đổi
	 * @param int $adding cần trừ hay là thêm lại sản phẩm 
	 * (nếu muốn tăng số lượng thì để 1, giảm số lượng thì để 0)
	 * @return void
	 */
	public function updateStock(int $id, int $quantity, int $adding){
		$adding = ($adding>0?1:($adding<0?-1:0));
		if($adding==0) return;
		else {
			$product = Product::where('id', $id)->first();
			$product->timestamps = false;
			error_log('truoc khi thay doi so luong: '.$product->stock);
			$product->stock += ($adding * $quantity) ;
			error_log('sau khi thay doi so luong : '.$product->stock);
			$product->save();
			return;
		}
	}

	public function getDetail (Request $request, $id){
		if($request->ajax() !== NULL) {
			$out = Product::find($id);
			if($out){
				return Response(json_encode(['status'=>1,'content' => $out->detail]));
			} else {
				return Response(json_encode(['status'=>0,'content' => trans('admin.product.message.errorgetproductdetail')]));
			}
		}
	}

	public function getOptions(Request $request, $product_id){
		if($request->ajax() !== NULL) {
			try {
				$options = DB::table('productclassifications')
				->where('product_id','=',$product_id)
				->get();
				return Response(json_encode(['status'=>1,'content' => $options]));
			} catch (Exception $e) {
				return Response(json_encode(['status'=>0,'content' => $e->getMessage()]));
			}
		}
		return Response(json_encode(['status'=>0,'content' => "NotAjax"]));

	}
	public function getImages(Request $request, $product_id){
		if($request->ajax() !== NULL) {
			try {
				$product = Product::find($product_id);
				return Response(json_encode(['status'=>1,'content' => $product->images]));
			} catch (Exception $e) {
				return Response(json_encode(['status'=>0,'content' => $e->getMessage()]));
			}
		}
		return Response(json_encode(['status'=>0,'content' => "NotAjax"]));

	}

	
}
