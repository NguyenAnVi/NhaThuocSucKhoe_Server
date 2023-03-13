<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use Illuminate\Support\Facades\Response;

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
			'title' =>'Danh sách banner',
		]);
		if($olddata!=NULL) 
			$data = array_merge($olddata,$newdata);
		else 
			$data = $newdata;
		return view('admin.manager.banner.index', $data);
	}

    public function create(Request $request)
    {
        return view('admin.layouts.create', [
            'title' => 'Thêm CTKM mới',
            'formView' => 'admin.manager.Banner.BannerAddForm',
        ]);
    }

    public function store(Request $request)
    {
        error_log('store banner');
        // validate NAME
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        // create Banner object and append data:
        $banner = new Banner;
        // disable timestamp adding:
        $banner->timestamps = false;

        $banner->name = $request->name;

        // option : add price_amount or add price_percent
        if ($request->boolean('price_check')) {
            $banner->amount = $request->price_amount;
            $banner->percent = 0;
        } else {
            $banner->amount = 0;
            $banner->percent = $request->price_percent;
        }

        // validate starttime and endtime: starttime must be before endtime
        if (strcmp($request->Banner_starttime, $request->Banner_endtime) < 0) {
            $banner->starttime = $request->Banner_starttime;
            $banner->endtime = $request->Banner_endtime;
        } else {
            return back()->withInput()->withErrors([
                'Banner_endtime' => 'Thời gian kết thúc KM phải lớn hơn thời gian bắt đầu',
            ]);
        }

        // check if banner
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $name = unified_format($banner->name) . '-' . time() . '.' . $file->extension();
            $file->storeAs('public/Banner/banners', $name);

            $banner->imageurl = asset('storage/Banner/banners').'/'.$name;
        } else {
            // make imageurl null if there's no banner
            $banner->imageurl = "";
        }

        $banner->save();

        return redirect()->route('admin.banner')->withErrors(['success' => 'Đã tạo thành công CTKM ' . $banner->name . '.']);
    }

    public function edit($banner)
    {
        $sf = Banner::find($banner);
            
        if($sf)
            return view('admin.layouts.edit',[
                'Banner' => $sf,
                'title' => 'Thay đổi thông tin CTKM',
                'formView' => 'admin.manager.Banner.BannerEditForm',
            ]);
        else return back()->withErrors(['warning'=>'Khong tim thay ID']);
    }

    public function update(Request $request, $id)
    {
        // find object
        error_log('banner update: id='.$id);
        $banner = Banner::find($id);

        // create Banner object and append data:
        // disable timestamp adding:
        $banner->timestamps = false;

        //affect count
        $prop = 0;

        if($banner->name != $request->name){
            // validate NAME
            $this->validate($request, [
                'name' => 'string|size:255',
            ]);
            $banner->name = $request->name;
            $prop ++;
        }
        
        if($banner->imageurl != $request->imageurl){
            // validate NAME
            $this->validate($request, [
                'name' => 'string|size:255',
            ]);
            $banner->name = $request->name;
            $prop ++;
        }

        if($request->has('change_price_check')){
            // option : add price_amount or add price_percent
            if ($request->boolean('price_check')) {
                if($request->price_amount > 0){
                    $banner->amount = $request->price_amount;
                    $banner->percent = 0;
                    $prop ++;
                } else {
                    return back()->withErrors([
                        'price_amount' => 'Tiền KM phải lớn hơn 0đ',
                    ]);
                }
            } else {
                if($request->price_percent > 0){
                $banner->amount = 0;
                $banner->percent = $request->price_percent;
                $prop ++;
                } else return back()->withInput()->withErrors([
                    'price_percent' => 'Phần trăm KM phải lớn hơn 0',
                ]);
            }
        }

        if($request->has('time_check')){
            // validate starttime and endtime: starttime must be before endtime
            if (strcmp($request->Banner_starttime, $request->Banner_endtime) < 0) {
                $banner->starttime = $request->Banner_starttime;
                $banner->endtime = $request->Banner_endtime;
                $prop ++;
            } else {
                return back()->withInput()->withErrors([
                    'Banner_endtime' => 'Thời gian kết thúc KM phải lớn hơn thời gian bắt đầu',
                ]);
            }
        }

        if($request->has('banner_check')){
            // 1. delete old image
            if($banner->imageurl != ""){
                $files = array_filter(
                    glob(
                        storage_path(
                            'app/public/Banner/banners/'
                            .explode("/",$banner->imageurl)[sizeof(explode("/",$banner->imageurl))-1]
                        )
                    )
                    ,"is_file"
                ); 
                foreach($files as $file)
                unlink($file); // delete file
            }

            // 2. add new image 
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $name = unified_format($banner->name) . '-' . time() . '.' . $file->extension();
                $file->storeAs('public/Banner/banners', $name);
    
                $banner->imageurl = asset('storage/Banner/banners').'/'.$name;
            } else {
                // make imageurl null if there's no banner
                $banner->imageurl = "";
            }
            $prop++;
        }
        
        $banner->save();

        // $last_inserted = $banner->id;

        return redirect()->route('admin.banner')->withErrors(['success' => $prop.' thuộc tính đã thay đổi.']);
    }

    public function destroy($id)
    {
        if($id!=1){
            $sf = Banner::find($id);
            // delete image
            if($sf->imageurl != ""){
                $files = array_filter(
                    glob(
                        storage_path(
                            'app/public/Banner/banners/'
                            .explode("/",$sf->imageurl)[sizeof(explode("/",$sf->imageurl))-1]
                        )
                    ),
                    "is_file"
                ); 
                foreach($files as $file)
                unlink($file); // delete file
            }

            // Remove product_Banner_id has this Banner
            $products = new AdminProductController();
            $affected_product_count = $products->removeBanner($sf->id);

            // delete record from database
            $sf->delete();

            if($affected_product_count){
                return redirect()->route('admin.banner')->withErrors(['success' => 'Đã xóa một CTKM, '.numToText($affected_product_count).' SP đã loại bỏ CTKM này']);    
            }
            return redirect()->route('admin.banner')->withErrors(['success' => 'Đã xóa 1 CTKM']);
        } else return redirect()->route('admin.banner')->withErrors(['warning' => 'Không thể xóa CTKM gốc']);
    }

	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('Banners')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}
