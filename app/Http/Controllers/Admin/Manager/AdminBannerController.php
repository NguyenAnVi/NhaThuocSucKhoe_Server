<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\HomeController;

class AdminBannerController extends Controller
{
    public function getAll($page = null){
        if($page) return Banner::paginate((int) $page);
        else return Banner::get();
    }

    public function getAllAjax(Request $request){
        if ($request->ajax()){
            return Response(json_encode($this->getAll()));
        }
    }

    public function index($olddata=NULL)
	{
        HomeController::checkAdminUser();
		$newdata = ([
			'collection' => $this->getAll(5),
		]);
		if($olddata!=NULL) 
			$data = array_merge($olddata,$newdata);
		else 
			$data = $newdata;
		return view('admin.manager.banner.index', $data);
	}

    public function create(Request $request)
    {
        HomeController::checkAdminUser();
        return view('admin.manager.banner.create');
    }

    public function store(Request $request)
    {
        HomeController::checkAdminUser();
        // validate NAME
        $this->validate($request, [
            'name' => 'string|max:255|unique:banners,name',
            'imageurl' => 'required|string|max:2048',
            'link' => 'required|string|max:2048'
        ] ,[
            'name.unique' => trans('admin.banner.message.duplicatename'),
        ]);

        // create Banner object and append data:
        $banner = new Banner;
        // disable timestamp adding:
        $banner->timestamps = false;
        
        $banner->name = $request->name;
        $banner->imageurl = $request->imageurl;
        $banner->link = $request->link;

        
        if ($request->has('status')) {
            $banner->status = 'ACTIVE';
        } else {
            $banner->status = 'INACTIVE';
        }
        
        $banner->save();

        return redirect()->route('admin.banner')->withErrors(['success' => trans('admin.banner.message.successfulcreatebanner', ['type'=> trans('admin.banner.banner'),'name'=>$banner->name])]);
    }

    public function update(Request $request, $id)
    {
        HomeController::checkAdminUser();

        // find object
        $banner = Banner::find($id);

        // create Banner object and append data:
        // disable timestamp adding:
        $banner->timestamps = false;

        //affect count
        $prop = 0;

        if($banner->name != $request->name){
            // validate NAME
            $this->validate($request, [
                'name' => 'string|max:255',
            ]);
            $banner->name = $request->name;
            $prop ++;
        }
        
        if($banner->imageurl != $request->imageurl){
            // validate NAME
            $this->validate($request, [
                'imageurl' => 'string|max:2048',
            ]);
            $banner->imageurl = $request->imageurl;
            $prop ++;
        }

        if($banner->link != $request->link){
            // validate NAME
            $this->validate($request, [
                'link' => 'string|max:2048',
            ]);
            $banner->link = $request->link;
            $prop ++;
        }

        if($request->has('status')){
            $banner->status = "ACTIVE";
        } else {
            $banner->status = "INACTIVE";
        }

        $banner->save();

        return redirect()->route('admin.banner')->withErrors(['success' => $prop.' thuộc tính đã thay đổi.']);
    }

    public function destroy($id)
    {
        HomeController::checkAdminUser();
        $banner = Banner::find($id);
        // delete image

        $banner->delete();

        return redirect()->route('admin.banner')->withErrors(['success' => trans('admin.banner.message.successfuldeletebanner')]);
        
    }

	public function requestSearch(Request $request ,$key)
	{
        HomeController::checkAdminUser();

        if ($request->ajax() !== NULL) {
			try {
				$list = DB::table('banners')
				->where('name', 'LIKE', '%' . $key . '%')
				->orWhere('status', 'LIKE', '%' . $key . '%')
				->get();
				
				return Response(
					json_encode([
						'list' => $list,
					])
				);
			} catch (\Exception $e) {
				return Response (json_encode(['error' => $e->getMessage()]));
			}
		}
	}
}
