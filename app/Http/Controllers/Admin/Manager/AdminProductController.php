<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SaleOff;
use Exception;

class AdminProductController extends Controller
{
	public function getAll(){
		return Product::all();
	}
	
	public function index($olddata=NULL)
	{
		$products = Product::paginate(5);
		$newdata = ([
			'collection' => $products,
			'title' =>'Danh sách sản phẩm',
			'createRoute' => route('admin.product.create'),
			'tableView' => 'admin.manager.product.productTable',

			'saleoffs' => SaleOff::all(),
		]);
		if($olddata!=NULL) 
			$data = array_merge($olddata,$newdata);
		else 
			$data = $newdata;
		return view('admin.layouts.index', $data);
	}

	public function create()
	{
		return view('admin.layouts.create', [
			'saleoffs' => SaleOff::all(),
			'title' => 'Thêm sản phẩm',
			'formView' => 'admin.manager.product.productAddForm',
		]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'price' => 'required',
			'category' => 'required',
			'saleoff' => 'required',
			'detail' => 'max:5000',
		]);
		
		$product= new Product();
		$product->timestamps = false;

		$product->name = $request->name;
		$product->price = $request->price;
		$product->saleoff_id = $request->saleoff;
		$product->category_id = $request->category;
		$product->stock = $request->stock;
		$product->detail = ($request->detail!=NULL)?$request->detail:"";
		$product->saleoff_id = ($request->saleoff<0)?0:$request->saleoff;
		$product->images = "";
		
		$product->save();

		if($request->has('images')){
			$count = 1;
			$files = [];
			foreach($request->file('images') as $file)
			{
				$name = $count.preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $product->name)) . '-' . time() . '.' . $file->extension();
				$file->storeAs('public/products/'.$product->id.'/', $name);
				$name = asset('storage/products/'.$product->id).'/'.$name;
				$files[] = $name;
				$count++;
				
			}
			
			$product->images = $files;
			// return view('tested', ['msg'=>$count.'.'.$product->name.'.'.$f ]);
		}else {
			// make imageurl null if there's no banner
			$product->images = "";
		}
		
		$product->save();
		return back()->withErrors(['success'=> 'Sản phẩm đã được thêm']);
	}

	public function edit($id)
	{
		$product = Product::find($id);
		if($product){
			return view('admin.layouts.edit',[
				'saleoffs' => SaleOff::all(),
				'product' => $product,
				'title' => 'Thay đổi thông tin sản phẩm',
				'formView' => 'admin.manager.product.productEditForm',
			]);
		}else return back()->withErrors(['warning'=>'Khong tim thay ID']);
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

		if($request->has('name_check')){
			// validate NAME
			$this->validate($request, [
				'name' => 'required|string',
			]);
			$product->name = $request->name;
			$prop ++;
		}

		if($request->has('price_check')){
			$this->validate($request, [
				'price' => 'required',
			]);
			if($request->price > 0){
				$product->price = $request->price;
				$prop ++;
			} else {
				return back()->withErrors([
					'price' => 'Giá bán phải lớn hơn 0đ',
				]);
			}
		}

		if($request->has('detail_check')){
			$this->validate($request, [
				'detail', 'string|max:5000',
			]);
			$product->detail = $request->detail;
			$prop ++;
		}

		if($request->has('saleoff_check')){
			if($request->saleoff > 0){
				$product->saleoff_id = $request->saleoff;
				$prop ++;
			} else {
				return back()->withErrors([
					'saleoff' => 'Saleoff không hợp lệ',
				]);
			}
		}

		if($request->has('images_check')){
			// 1. delete old images
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
				try{
					rmdir(storage_path(
						'app/public/products/'.$product->id
					));
				} catch (\Exception $e) {
					echo '';
				};
				
			}

			// 2. add new images
			if($request->has('images')){
				$count = 1;
				$files = [];
				foreach($request->file('images') as $file)
				{
					$name = $count.preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $product->name)) . '-' . time() . '.' . $file->extension();
					$file->storeAs('public/products/'.$product->id.'/', $name);
					$name = asset('storage/products/'.$product->id).'/'.$name;
					$files[] = $name;
					$count++;
				}
				
				$product->images = $files;
			}else {
				// make imageurl null if there's no banner
				$product->images = "";
			}
			
			
			$prop++;
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

	// public function loadMore(Request $request){
	// 	if($request->ajax()){

	// 		return Response();
	// 	}
	// }

	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}

	public function removeSaleoff($saleoff_id){
		$check = 0;
		$products = Product::where('saleoff_id', $saleoff_id)->get();
		foreach ($products as $item){
			$item->timestamps = false;
			$item->saleoff_id = 1;
			$item->save();
			$check++;
		}
		return $check;
	}

	/**
	 * cập nhật lại số lượng sản phẩm khi có thay đổi về đơn hàng
	 * @param int $id mã sản phẩm
	 * @param int $quantity số lượng sản phẩm cần thay đổi
	 * @param int $multiplier cần trừ hay là thêm lại sản phẩm 
	 * (nếu muốn tăng số lượng thì để 1, giảm số lượng thì để 0)
	 * @return void
	 */
	public function restock(int $id, int $quantity, int $multiplier){
		$multiplier = ($multiplier>0?1:($multiplier<0?-1:0));
		if($multiplier==0) return;
		else {
			$product = Product::where('id', $id)->first();
			$product->timestamps = false;
			error_log('truoc khi thay doi so luong: '.$product->stock);
			$product->stock += ($multiplier * $quantity) ;
			error_log('sau khi thay doi so luong : '.$product->stock);
			$product->save();
			return;
		}
	}
}
