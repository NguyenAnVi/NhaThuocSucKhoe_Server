<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        // echo 'Xin chào Admin, '. $user->name;

        return view('admin.home');
    }

    public function notFound()
    {
        if (ob_get_level()) {
            ob_end_clean();
        }
                
        http_response_code(404);
        echo view('admin.errors.404');
        exit();      
    }
}

