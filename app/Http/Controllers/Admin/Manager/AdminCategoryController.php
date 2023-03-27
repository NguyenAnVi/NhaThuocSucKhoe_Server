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

	// public function getAllLeafAjax(Request $request){
	// 	if($request->ajax()!==NULL){
	// 		return Response(json_encode($this->getAllLeaf()));
	// 	}

	// }

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
		// return view('admin.layouts.index',[
		// 	'collection' => $this->getAll(5),
		// 	'title' => 'Danh sách các danh mục',
		// 	'createRoute' => route('admin.category.create'),
		// 	'tableView' => 'admin.manager.category.categoryTable',
		// ]);
	}

	public function create()
	{
		// return view('admin.layouts.create', [
		// 	'categories' => $this->getAll(),
		// 	'title' => 'Thêm danh muc',
		// 	'formView' => 'admin.manager.category.categoryAddForm',
		// ]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'detail' => 'max:5000',
		]);
		try{
			$category = new Category();
			$category->timestamps = false;
			$category->name = $request->name;
			$category->parent_id = $request->parent_id;
			$category->detail = (!$request->detail)?(''):$request->detail;
			$category->status = ($request->status)?(1):(0);
			$category->save();

			return back()->withInput()->withErrors(['success'=> 'Tạo danh mục thành công']);

		}catch (\Exception $err){
			//session::flash('error',$err->getMessage());
			return back()->withInput()->withErrors(['danger'=> 'Tạo danh mục không thành công: '.$err->getMessage()]);
		}

		return true;
		return back()->withInput()->withErrors(['danger'=> 'Tạo danh mục không thành công']);
	}


	// public function edit($id)
	// {
	// 	$category = Category::find($id);
	// 	if($category)
	// 		return view('admin.layouts.edit',[
	// 			'category' => $category,
	// 			'categories' => $this->categoryService->getParent(),
	// 			'title' => 'Thay đổi thông tin danh mục',
	// 			'formView' => 'admin.manager.category.categoryEditForm',
	// 		]);
	// 	else return back()->withErrors(['warning'=>'Khong tim thay ID']);
	// }

	public function update($id, Request $request)
	{
		HomeController::checkRootUser();
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

				// if ($request->has('parent_id_check')){
				if ($request->parentid != $category->parent_id){
					if(($request->parentid == $category->id)){
						return back()->withErrors(['error' => trans('admin.category.message.cannotfindparentiditself')]);
					}
					if( (DB::table('categories')->where('parent_id', 0)->find($request->parentid) === NULL) && ($request->parentid != 0))
						return back()->withErrors(['parent_id.exists' => trans('admin.category.message.cannotfindparentid')]);
					$category->parent_id = $request->parentid;
					$prop++;
				}

				// if ($request->has('detail_check')){
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
		$menu = Category::where('id', $id)->first();

		try{
			if ($menu){
				$countChildren = 0;
				foreach($this->getChildren($id) as $item){
					$this->destroy($item->id);
					$countChildren++;
				}

				foreach($this->getRelativeProduct($id) as $item){
					$product = new AdminProductController();
					try{
						$product->destroy($item->id);
					} catch (\Exception $e){
						return back()->withErrors([
							'danger'=>'Có lỗi xảy ra khi xóa Danh mục : '.$e->getMessage(),
						]);
					}
				}
				Category::where('id', $id)->delete();

				return back()->withErrors([
					'success' => 'Xóa thành công danh mục '.$id.', '.$countChildren.' danh mục con đã được xóa.',
				]);
			}
		} catch (\Exception $e) {
			return back()->withErrors([
				'danger'=>'Có lỗi xảy ra khi xóa Danh mục : '.$e->getMessage(),
			]);
		}
	}

	public function switchstatus( Request $request)
	{
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