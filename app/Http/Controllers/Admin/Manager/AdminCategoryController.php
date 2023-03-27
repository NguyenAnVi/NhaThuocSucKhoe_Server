<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
	protected $categoryService;

	public function __construct(CategoryService $categoryService)
	{
		$this->categoryService = $categoryService;
	}

	public function getRelativeProduct($categoryid){
		$product = new AdminProductController();
		return $product->getAll()->where('category_id', $categoryid);
	}

	public function getChildren($categoryid){
		$c = Category::where('parent_id', $categoryid)->get();
		return $c;
	}

	public function getAllLeafs(){

		// SELECT leaf.node_id
		// FROM tree AS leaf
		// LEFT OUTER JOIN tree AS child on child.parent = leaf.node_id
		// WHERE child.node_id IS NULL

		return DB::table('categories as leaf')
							->select('leaf.*')
							->leftJoin('categories as child','child.parent_id', '=', 'leaf.id')
							->whereNull('child.id')
							->get();
	}

	public function getAllParents(){
		return DB::table('categories')->where('id',0)->orWhere('parent_id', 0)->get();
	}

	public function getAll($pages = 0)
	{
		if($pages == 0)	return Category::orderby('id', 'asc')->get();
		else return Category::orderby('id', 'asc')->paginate($pages);
	}
	
	public function index()
	{
		HomeController::checkAdminUser();
		$data = [
			'collection' => $this->getAll(5),
			'categoryparentnodes' => $this->getAllParents(),
		];
		return view('admin.manager.category.index', $data);
	}

	public function store(Request $request)
	{
		HomeController::checkAdminUser();

		$this->validate($request, [
			'name' => 'required',
			'parentid' => 'exists:categories,id',
			'detail' => 'string|nullable|max:65535',
			'imageurl' => 'string|max:2048',
		]);
		try{
			$category = new Category();
			$category->timestamps = false;
			$category->name = $request->name;
			$category->parent_id = $request->parentid;
			$category->detail = ($request->detail)?$request->detail:('');
			$category->imageurl = $request->imageurl;
			$category->status = ($request->has('status'))?(1):(0);
			$category->save();

			return back()->withInput()->withErrors(['success'=> trans('admin.category.message.successfulcreate')]);

		}catch (\Exception $err){
			return back()->withInput()->withErrors(['danger'=> trans('admin.category.message.errorcreatingcategory').'('.$err->getMessage().')']);
		}
		return back()->withInput()->withErrors(['danger'=> trans('admin.category.message.errorcreatingcategory')]);
	}

	public function update($id, Request $request)
	{
		HomeController::checkAdminUser();

		$category = Category::find($id);

		if($category){
			try{
				$prop = 0;
				$category->timestamps = false;
				// if ($request->has('name_check')){
				if ($request->name != $category->name){
					$this->validate($request, [
						'name' => 'required|string|max:255',
					]);
					$category->name = $request->name;
					$prop++;
				}

				if ($request->parentid != $category->parent_id){
					if(($request->parentid == $category->id)){
						return back()->withErrors(['error' => trans('admin.category.message.cannotfindparentiditself')]);
					}
					if( (DB::table('categories')->where('parent_id', 0)->find($request->parentid) === NULL) && ($request->parentid != 0))
						return back()->withErrors(['parent_id.exists' => trans('admin.category.message.cannotfindparentid')]);
					$category->parent_id = $request->parentid;
					$prop++;
				}

				if ($request->detail !== $category->detail){
					$this->validate($request, [
						'detail' => 'max:65535',
					]);
					$category->detail = $request->detail;
					$prop++;
				}

				if ($request->imageurl !== $category->imageurl){
					$this->validate($request, [
						'imageurl' => 'max:65535',
					]);
					$category->imageurl = $request->imageurl;
					$prop++;
				}

				if ($request->has('status')){
					if($category->status==0){
						$category->status = (1);
						$prop++;
					}
				} else {
					if($category->status==1){
						$category->status = (0);
						$prop++;
					}
				}

				$category->save();
			} catch(\Exception $e){
				return back()->withInput()->withErrors(['danger'=> trans('admin.category.message.errorupdating',['msg'=>$e->getMessage()])]);
			}
			// Update successfully
		}
		else{
			return back()->withErrors([
				'danger' => trans('admin.category.message.cannotfindid'),
			]);
		}
		return back()->withErrors(['success'=> trans('admin.category.message.successfulupdating', ['prop'=>$prop])]);
	}

	public function destroy(int $id)
	{
		HomeController::checkAdminUser();
		$category = Category::find($id);

		try{
			if ($category){
				$countcategories = 0;
				foreach($this->getChildren($id) as $item){
					$this->destroy($item->id);
					$countcategories++;
				}

				$countproducts = 0;
				foreach($this->getRelativeProduct($id) as $item){
					$product = new AdminProductController();
					try{
						$product->destroy($item->id);
						$countproducts++;
					} catch (\Exception $e){
						return back()->withErrors([
							'danger'=>trans('admin.category.message.errordeletingcategory').'('.$e->getMessage().')',

						]);
					}
				}
				Category::where('id', $id)->delete();

				return back()->withErrors([
					'success' => trans('admin.category.message.successfuldeletecategorywithproduct', ['id'=>$id ,'category' => $countcategories, 'product'=>$countproducts]),
				]);
			} else {
				return back()->withErrors(['danger'=>trans('admin.category.message.cannotfindid')]);
			}
		} catch (\Exception $e) {
			return back()->withErrors([
				'danger'=>trans('admin.category.message.errordeletingcategory').'('.$e->getMessage().')',
			]);
		}
	}

	public function switchstatus( Request $request)
	{
		HomeController::checkAdminUser();

		if ($request->ajax()) {
			$c = Category::find($request->id);
			$c->timestamps = false;
			$c->status = ($c->status==0)?(1):(0);
			$c->save();
			return Response((checkStatus(intval($c->id), intval($c->status))));  
			// return Response('thanh cong');
		}
	}

	public function search (Request $request){
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('categories')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}

	public function getDetail (Request $request, $id){
		if($request->ajax() !== NULL) {
			$cat = Category::find($id);
			if($cat){
				return Response(json_encode(['status'=>1,'content' => $cat->detail]));
			} else {
				return Response(json_encode(['status'=>0,'content' => '']));
			}
		}
	}
}