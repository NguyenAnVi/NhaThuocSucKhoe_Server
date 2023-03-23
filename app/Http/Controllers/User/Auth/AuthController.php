<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            if(Auth::user()){
                return redirect()->route('home')->withErrors('Bạn đã đăng nhập với tên '.Auth::user()->name);
            }
            return view('user.auth.login');
        }

        else 
        {
            $request->validate([
                'phone' => 'required',
                'password' => 'required'
            ]);
            $credentials = $request->only(['phone', 'password']);
            if (Auth::attempt($credentials)) {
                return redirect()->route('home')->withErrors(trans('auth.msg.loginsuccess'));
            } else {
                return back()->withErrors('Số điện thoại hoặc mật khẩu sai');
            }
        }
    }

    // public function checkphone(Request $request)
    // {
    //     $phone = $request->phone;
    //     if(strlen($phone)!=10)
    //         $data = ['response_code' => 2];
    //     else {
    //         $user = User::where('phone',$phone)->first();
    //         $data = [
    //             'phone' => $phone,
    //             'response_code' => ($user !== NULL)?(0):(1),
    //         ];
    //     }
        
    //     return Response(json_encode($data));
    // }

    public function checkphone(Request $request)
    {
        $result = '';
        if(($request->ajax() !== NULL))
        {
            $phone = $request->phone;
            // if(preg_match("/^[+]?[1-9][0-9]{9,14}$/", $phone)){
            if(preg_match("/^[0]{1}[1-9]{1}[0-9]{8}$/", $phone)){
                $user = User::where('phone',$phone)->first();
                if($user){
                $result = '<div class="uk-text-italic uk-text-danger ">'.trans('general.msg.phonenumberisused').'❌'.'</div>';
                $status = 0;
                }else{
                    $result = '<div class="uk-text-italic uk-text-success ">'.trans('general.msg.phonenumberavailable').'✅'.'</div>';
                    $status = 1;
                } 
            } else {
                $result = '<div class="uk-text-italic uk-text-danger ">'.trans('general.msg.invalidphonenumber').'❌'.'</div>';
                $status = 0;
            }
            
        }else{
            error_log('not ajax');
            $result = '<div class="uk-text-italic uk-text-danger ">'.trans('general.msg.erroroccurred').'❌'.'</div>';
            $status = 1;
        }
        return Response(json_encode(['result'=>$result, 'status' =>$status]));
    }

    public function register(Request $request)
    {
        if($request->getMethod() == 'GET') {
            return view('user.auth.register');
        }
        return $this->postRegister($request);
    }

    public function postRegister(Request $request)
    {
        $request->only(['name', 'phone', 'password']);
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'point' => 0,
        ]);
        $data=([
            'general_message' => 'Tạo tài khoản thành công.',
            'general_message_type' => 'success',
        ]);
        return view('user.auth.login', $data);
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('home');
    }
}

