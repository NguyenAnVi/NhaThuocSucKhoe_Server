<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Manager\AdminProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('admin/product/uploadImageEditor', function (Request $request){
    // if(!$_FILES["file"]["error"]){
    //     // Allowed extentions.
    //     $allowedExts = array("gif", "jpeg", "jpg", "png", "webp");
    //     // Get filename.
    //     $temp = explode(".", $_FILES["file"]["name"]);
    //     // Get extension.
    //     $extension = end($temp);

    //     // An image check is being done in the editor but it is best to
    //     // check that again on the server side.
    //     // Do not use $_FILES["file"]["type"] as it can be easily forged.
    //     $finfo = finfo_open(FILEINFO_MIME_TYPE);
    //     $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
    //     error_log(1);

    //     if ((($mime == "image/gif")
    //     || ($mime == "image/jpeg")
    //     || ($mime == "image/pjpeg")
    //     || ($mime == "image/x-png")
    //     || ($mime == "image/png")
    //     || ($mime == "image/webp"))
    //     && in_array($extension, $allowedExts)) {
    //         error_log(2);
    //         // Generate new random name.
    //         error_log($_FILES["file"]["tmp_name"]);
    //         error_log(storage_path("public/uploads/".$_FILES['file']['name']));
    //         // Save file in the uploads folder.
    //         // $_FILES['file']['tmp_name']->storeAs("public/uploads/",$name);
    //         move_uploaded_file($_FILES['file']['name'], storage_path("public/uploads/".$_FILES['file']['name']));
    //         error_log(3);
    //         // Generate response.
    //         $response = new stdClass;
    //         $response->link = asset('storage/uploads/'. $_FILES['file']['name']);
    //         error_log($response->link);
    //         echo stripslashes(json_encode($response));
    //         error_log(4);
    //     }
    //     error_log(5);
        
    // }
    // else{
    //     $response = new stdClass;
    //     // $response->link = asset('storage/uploads').$name;
    //     error_log($response->link);
    //     echo stripslashes(json_encode($response));
    //     // return Response();
    // }
})->name('api.product.upload');
