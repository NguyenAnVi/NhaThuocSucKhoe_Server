<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Image;
use Exception;
class AdminImageController extends Controller
{
    public function getAll($page = null){
        if($page) return Image::paginate((int) $page);
        else return Image::get();
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
        return view('admin.layouts.create', [
            'title' => 'Thêm CTKM mới',
            'formView' => 'admin.manager.Banner.BannerAddForm',
        ]);
    }

    public function store(Request $request)
    {
        // validate NAME
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        // create Banner object and append data:
        $Banner = new Banner;
        // disable timestamp adding:
        $Banner->timestamps = false;

        $Banner->name = $request->name;

        // option : add price_amount or add price_percent
        if ($request->boolean('price_check')) {
            $Banner->amount = $request->price_amount;
            $Banner->percent = 0;
        } else {
            $Banner->amount = 0;
            $Banner->percent = $request->price_percent;
        }

        // validate starttime and endtime: starttime must be before endtime
        if (strcmp($request->Banner_starttime, $request->Banner_endtime) < 0) {
            $Banner->starttime = $request->Banner_starttime;
            $Banner->endtime = $request->Banner_endtime;
        } else {
            return back()->withInput()->withErrors([
                'Banner_endtime' => 'Thời gian kết thúc KM phải lớn hơn thời gian bắt đầu',
            ]);
        }

        // check if banner
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $name = unified_format($Banner->name) . '-' . time() . '.' . $file->extension();
            $file->storeAs('public/Banner/banners', $name);

            $Banner->imageurl = asset('storage/Banner/banners').'/'.$name;
        } else {
            // make imageurl null if there's no banner
            $Banner->imageurl = "";
        }

        $Banner->save();

        return redirect()->route('admin.banner')->withErrors(['success' => 'Đã tạo thành công CTKM ' . $Banner->name . '.']);
    }

    public function destroy($id)
    {
        if($id!=1){
            $sf = Image::find($id);
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

    public function upload(Request $request)
	{
        try {
            if ($request->ajax()!== NULL) {
                
                $uid = $request->input('uid');
                $tnow = time();
                if($request->file('image')){
                    $filename = $tnow.'.'.$uid.'.png';
                    try {
                        $request->file('image')->storeAs('public/images/uploads/', $filename);
                        error_log('New image is uploaded('.$filename.').');
                        $image = new Image();
                        $image->timestamps = true;
                        $image->url = asset('storage/images/uploads/'.$filename);
                        $image->path = "/images/uploads/".$filename;
                        $image->uid = $uid;
                        $image->save();
                        return Response(json_encode([
                            'status' => 'success',
                            'url' => $image->url,
                        ]));
                    }catch (Exception $ue){
                        error_log('Error while uploading image: '.$ue->getMessage());
                    }
                    return Response(json_encode([
                        'status' => 'error',
                    ]));
                }
            }
        } catch (\Error $th) {
            return Response(json_encode(['Error while call function upload: '. $th->getMessage()]));
        }
	}

	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('Banners')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}
