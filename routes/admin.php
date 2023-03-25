
<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Manager\AdminAccountController;
use App\Http\Controllers\Admin\Manager\AdminCustomerController;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use App\Http\Controllers\Admin\Manager\AdminBannerController;
use App\Http\Controllers\Admin\Manager\AdminImageController;
use App\Http\Controllers\Admin\Manager\AdminCategoryController;
use App\Http\Controllers\Admin\Manager\AdminOrderController;



Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('admin.login');
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::middleware('auth:admin')->group(function () {
    Route::prefix('')->group(function () {
        Route::get('settings', [HomeController::class, 'settings'])->name('admin.settings');

        Route::get('/home',[HomeController::class, 'index'])->name('admin.home');

        Route::get('/', function(){
            return redirect('/admin/home');
        });

        // Manage Admin Account route
        Route::resource('account', AdminAccountController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.account',
                'create' => 'admin.account.create',
                'store' => 'admin.account.store',
                'edit' => 'admin.account.edit',
                'update' => 'admin.account.update',
                'destroy' => 'admin.account.destroy'
            ]);
        Route::post('account/grant', [AdminAccountController::class, 'requestGrantAccess'])->name('admin.account.grantaccess');
        Route::post('account/changepassword', [AdminAccountController::class, 'requestChangePassword'])->name('admin.account.changepassword');
        Route::get('account/search/{key}', [AdminAccountController::class, 'requestSearch'])->name('admin.account.search');

        // Manage banner route
        Route::resource('banner', AdminBannerController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.banner',
                'create' => 'admin.banner.create',
                'store' => 'admin.banner.store',
                'edit' => 'admin.banner.edit',
                'update' => 'admin.banner.update',
                'destroy' => 'admin.banner.destroy'
            ]
        );
        Route::get('banner/search/{key}', [AdminBannerController::class, 'requestSearch'])->name('admin.banner.search');
        Route::get('banner/getall', [AdminBannerController::class, 'getAllAjax'])->name('admin.banner.getall');

         // Manage image route
         Route::resource('image', AdminImageController::class)
         ->except(['show', 'update' ,'edit'])
         ->names([
             'index' => 'admin.image',
             'create' => 'admin.image.create',
             'store' => 'admin.image.store',
             'destroy' => 'admin.image.destroy'
         ]);
        Route::post('image/upload', [AdminImageController::class, 'upload'])->name('admin.image.upload');


        Route::resource('product', AdminProductController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.product',
                'create' => 'admin.product.create',
                'store' => 'admin.product.store',
                'edit' => 'admin.product.edit',
                'update' => 'admin.product.update',
                'destroy' => 'admin.product.destroy'
            ]);
        Route::get('product/search', [AdminProductController::class, 'search'])->name('admin.product.search');

        Route::resource('category', AdminCategoryController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.category',
                'create' => 'admin.category.create',
                'store' => 'admin.category.store',
                'edit' => 'admin.category.edit',
                'update' => 'admin.category.update',
                'destroy' => 'admin.category.destroy'
            ]
        );
        Route::get('category/getallleaf', [AdminCategoryController::class, 'getAllLeafAjax'])->name('admin.category.getallleaf');
        Route::post('category/switchstatus', [AdminCategoryController::class, 'switchstatus'])->name('admin.category.switchstatus');
        Route::get('category/search', [AdminCategoryController::class, 'search'])->name('admin.category.search');

        // ORDER management
        Route::get('order', [AdminOrderController::class, 'index'])->name('admin.order');
        Route::get('order/all', [AdminOrderController::class, 'all'])->name('admin.order.all');
        Route::get('order/pending', [AdminOrderController::class, 'pending'])->name('admin.order.getPending');
        Route::get('order/detail', [AdminOrderController::class, 'detail'])->name('admin.order.getDetail');
        Route::get('order/search', [AdminOrderController::class, 'search'])->name('admin.order.search');
        Route::post('order/switchstatus', [AdminOrderController::class, 'switchstatus']);
    });
    Route::match('get', '/language/{locale}', [HomeController::class, 'setlocale']);

    Route::fallback([HomeController::class, 'notFound']);
});
