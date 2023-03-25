<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public static function getCurrentUser()
	{
		return Auth::guard('admin')->user();
	}

	public static function refuseAction()
	{
		if (ob_get_level()) {
            ob_end_clean();
		}
						
		echo view('shared.errors.refusepermission');
        exit();
	}

	public static function checkGrandRootUser($mode=NULL, $user=NULL)
	{	
		if (($user && ($user->id === 1)) || (Auth::user()->id === 1))
			return true;	
		else{
			if(!$mode) return self::refuseAction();
			else return false;
		}
			
	}

	public static function checkRootUser($mode=NULL, $user=NULL)
	{	
		if (($user && ($user->role === "ROOT")) || (Auth::user()->role === "ROOT"))
			return true;	
		else
				if(!$mode) return self::refuseAction();
				else return false;
	}

    public static function checkAdminUser($user=NULL)
	{	
		if (($user && ($user->role === "ADMIN")) || (Auth::user()->role === "ADMIN") || self::checkRootUser($user))
			return true;	
		else
			return self::refuseAction();
	}

    public function index($locale=null)
    {
        self::checkAdminUser();
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
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

