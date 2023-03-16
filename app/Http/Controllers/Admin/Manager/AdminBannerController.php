<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use Illuminate\Support\Facades\Response;

use function PHPUnit\Framework\returnSelf;

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
        return view('admin.manager.banner.create');
    }

    public function store(Request $request)
    {
        error_log('store banner');
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

        
        // option : add price_amount or add price_percent
        if ($request->has('status')) {
            $banner->status = 'ACTIVE';
        } else {
            $banner->status = 'INACTIVE';
        }
        
        $banner->save();

        return redirect()->route('admin.banner')->withErrors(['success' => trans('admin.banner.message.successfulcreatebanner', ['type'=> trans('admin.banner.banner'),'name'=>$banner->name])]);
    }

    // public function edit($id)
    // {
    //     $banner = Banner::find($id);
            
    //     if($banner)
    //         return view('admin.manage.banner.edit',[
    //             'Banner' => $banner,
    //             'title' => 'Thay đổi thông tin CTKM',
    //             'formView' => 'admin.manager.Banner.BannerEditForm',
    //         ]);
    //     else return back()->withErrors(['warning'=>'Khong tim thay ID']);
    // }

    

    public function update(Request $request, $id)
    {
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
        $banner = Banner::find($id);
        // delete image

        $banner->delete();

        return redirect()->route('admin.banner')->withErrors(['success' => trans('admin.banner.message.successfuldeletebanner',['type', trans('admin.banner.banner')])]);
        
    }

	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('Banners')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}
