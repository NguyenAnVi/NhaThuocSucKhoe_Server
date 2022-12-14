<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\SaleOff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use Illuminate\Support\Facades\Response;

class AdminSaleOffController extends Controller
{
    public function getAll($page = null){
        if($page) return SaleOff::paginate((int) $page);
        else return SaleOff::get();
    }

    public function getAllAjax(Request $request){
        if ($request->ajax()){
            return Response(json_encode($this->getAll()));
        }
    }

    public function index($olddata=NULL)
	{
        $saleoffs = DB::table('saleoffs')->paginate(5);
		$newdata = ([
			'collection' => $saleoffs,
			'title' =>'Danh sách chương trình khuyến mãi',
			'createRoute' => route('admin.saleoff.create'),
			'tableView' => 'admin.manager.saleoff.saleoffTable',
		]);
		if($olddata!=NULL) 
			$data = array_merge($olddata,$newdata);
		else 
			$data = $newdata;
		return view('admin.layouts.index', $data);
	}

    public function create(Request $request)
    {
        return view('admin.layouts.create', [
            'title' => 'Thêm CTKM mới',
            'formView' => 'admin.manager.saleoff.saleoffAddForm',
        ]);
    }

    public function store(Request $request)
    {
        // validate NAME
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        // create Saleoff object and append data:
        $saleoff = new SaleOff;
        // disable timestamp adding:
        $saleoff->timestamps = false;

        $saleoff->name = $request->name;

        // option : add price_amount or add price_percent
        if ($request->boolean('price_check')) {
            $saleoff->amount = $request->price_amount;
            $saleoff->percent = 0;
        } else {
            $saleoff->amount = 0;
            $saleoff->percent = $request->price_percent;
        }

        // validate starttime and endtime: starttime must be before endtime
        if (strcmp($request->saleoff_starttime, $request->saleoff_endtime) < 0) {
            $saleoff->starttime = $request->saleoff_starttime;
            $saleoff->endtime = $request->saleoff_endtime;
        } else {
            return back()->withInput()->withErrors([
                'saleoff_endtime' => 'Thời gian kết thúc KM phải lớn hơn thời gian bắt đầu',
            ]);
        }

        // check if banner
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $name = unified_format($saleoff->name) . '-' . time() . '.' . $file->extension();
            $file->storeAs('public/saleoff/banners', $name);

            $saleoff->imageurl = asset('storage/saleoff/banners').'/'.$name;
        } else {
            // make imageurl null if there's no banner
            $saleoff->imageurl = "";
        }

        $saleoff->save();

        return redirect()->route('admin.saleoff')->withErrors(['success' => 'Đã tạo thành công CTKM ' . $saleoff->name . '.']);
    }

    public function edit($saleoff)
    {
        $sf = SaleOff::find($saleoff);
            
        if($sf)
            return view('admin.layouts.edit',[
                'saleoff' => $sf,
                'title' => 'Thay đổi thông tin CTKM',
                'formView' => 'admin.manager.saleoff.saleoffEditForm',
            ]);
        else return back()->withErrors(['warning'=>'Khong tim thay ID']);
    }

    public function update(Request $request, $saleoff)
    {
        // find object
        $saleoff = SaleOff::find($saleoff);

        // create Saleoff object and append data:
        // disable timestamp adding:
        $saleoff->timestamps = false;

        //affect count
        $prop = 0;

        if($request->has('name_check')){
            // validate NAME
            $this->validate($request, [
                'name' => 'required|string',
            ]);
            $saleoff->name = $request->name;
            $prop ++;
        }

        if($request->has('change_price_check')){
            // option : add price_amount or add price_percent
            if ($request->boolean('price_check')) {
                if($request->price_amount > 0){
                    $saleoff->amount = $request->price_amount;
                    $saleoff->percent = 0;
                    $prop ++;
                } else {
                    return back()->withErrors([
                        'price_amount' => 'Tiền KM phải lớn hơn 0đ',
                    ]);
                }
            } else {
                if($request->price_percent > 0){
                $saleoff->amount = 0;
                $saleoff->percent = $request->price_percent;
                $prop ++;
                } else return back()->withInput()->withErrors([
                    'price_percent' => 'Phần trăm KM phải lớn hơn 0',
                ]);
            }
        }

        if($request->has('time_check')){
            // validate starttime and endtime: starttime must be before endtime
            if (strcmp($request->saleoff_starttime, $request->saleoff_endtime) < 0) {
                $saleoff->starttime = $request->saleoff_starttime;
                $saleoff->endtime = $request->saleoff_endtime;
                $prop ++;
            } else {
                return back()->withInput()->withErrors([
                    'saleoff_endtime' => 'Thời gian kết thúc KM phải lớn hơn thời gian bắt đầu',
                ]);
            }
        }

        if($request->has('banner_check')){
            // 1. delete old image
            if($saleoff->imageurl != ""){
                $files = array_filter(
                    glob(
                        storage_path(
                            'app/public/saleoff/banners/'
                            .explode("/",$saleoff->imageurl)[sizeof(explode("/",$saleoff->imageurl))-1]
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
                $name = unified_format($saleoff->name) . '-' . time() . '.' . $file->extension();
                $file->storeAs('public/saleoff/banners', $name);
    
                $saleoff->imageurl = asset('storage/saleoff/banners').'/'.$name;
            } else {
                // make imageurl null if there's no banner
                $saleoff->imageurl = "";
            }
            $prop++;
        }
        
        $saleoff->save();

        // $last_inserted = $saleoff->id;

        return redirect()->route('admin.saleoff')->withErrors(['success' => $prop.' thuộc tính đã thay đổi.']);
    }

    public function destroy($id)
    {
        if($id!=1){
            $sf = SaleOff::find($id);
            // delete image
            if($sf->imageurl != ""){
                $files = array_filter(
                    glob(
                        storage_path(
                            'app/public/saleoff/banners/'
                            .explode("/",$sf->imageurl)[sizeof(explode("/",$sf->imageurl))-1]
                        )
                    ),
                    "is_file"
                ); 
                foreach($files as $file)
                unlink($file); // delete file
            }

            // Remove product_saleoff_id has this saleoff
            $products = new AdminProductController();
            $affected_product_count = $products->removeSaleoff($sf->id);

            // delete record from database
            $sf->delete();

            if($affected_product_count){
                return redirect()->route('admin.saleoff')->withErrors(['success' => 'Đã xóa một CTKM, '.numToText($affected_product_count).' SP đã loại bỏ CTKM này']);    
            }
            return redirect()->route('admin.saleoff')->withErrors(['success' => 'Đã xóa 1 CTKM']);
        } else return redirect()->route('admin.saleoff')->withErrors(['warning' => 'Không thể xóa CTKM gốc']);
    }

	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('saleoffs')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}
