<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Csrf;
use App\SessionGuard as Guard;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function invokeCsrfGuard()
    {
        if (! Csrf::verifyToken()) {
            Guard::logout();
            return route('admin.home');
        }        
    }    
}
