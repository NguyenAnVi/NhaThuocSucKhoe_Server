<?php

namespace App;

use App\Models\Admin;
use App\Csrf;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SessionGuard
{
    protected static $admin;

    public static function login(Admin $admin, array $credentials)
    {
        $verified = password_verify($credentials['password'], $admin->password);
        if ($verified) {
            $_SESSION['id'] = $admin->id;
            // Tạo lại CSRF token sau khi đăng nhập
            Csrf::generateToken();
        }
        return $verified;
    }

    public static function admin()
    {
        if (! static::$admin && static::checkLogin()) {
            static::$admin = admin::find($_SESSION['id']);
        }
        return static::$admin;
    }


    public static function logout()
    {
        static::$admin = null;
    }

    public static function checkLogin()
    {
        return isset($_SESSION['id']);    
    }
}
