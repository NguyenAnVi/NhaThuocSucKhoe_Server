<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index($locale=null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }

        // $user = Auth::guard('admin')->user();
        // echo 'Xin chào Admin, '. $user->name;

        return view('admin.home');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function setlocale($locale){
		if (! in_array($locale, ['en', 'vi'])) {
			abort(400);
		}	

		app()->setLocale((string)$locale);
		session()->put('locale', $locale);

		return redirect()->back()->withErrors([
			'success' => __('notification.setlanguagesuccess'),
		]);
	}

    public function notFound()
    {
        if (ob_get_level()) {
            ob_end_clean();
        }
                
        http_response_code(404);
        echo view('shared.errors.404');
        exit();      
    }
}

