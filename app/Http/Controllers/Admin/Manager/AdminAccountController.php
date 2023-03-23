<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\FakeEnums\AccessPermissions;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminAccountController extends Controller
{
	public function index($olddata = NULL)
	{
		$check = HomeController::checkAdminUser();
		$users = DB::table('users')->paginate(5);
			
			if ($check) {
				$newdata = ([
					'collection' => $users,
					'available_roles'=> AccessPermissions::getAll(),
				]);
				if ($olddata != NULL) $data = array_merge($olddata, $newdata);
				else $data = ($newdata);
				return view('admin.manager.account.index', $data);
			} else {
					return $this->rejectAction();
			}
	}

	public function create()
	{
		$check = $this->checkRootUser($this->getCurrentUser());
		if ($check) {
			return view('admin.manager.account.create');
		} else {
			return $this->rejectAction();
		}
	}

	public function store(Request $request)
	{
		$check = $this->checkRootUser($this->getCurrentUser());
		if ($check) {
			//if the User is ROOT
			$request->only(['name', 'phone', 'password']);
			$request->validate([
				'name' => 'required|string|max:255',
				'phone' => 'required|string|size:10|unique:users',
				'password' => 'required|min:6',
			], [
				'name.required' => 'Bạn cần nhập tên',
				'name.max' => 'Tên nhân viên không vượt quá :max kí tự.',
				'phone.unique' => trans('general.msg.phonenumberisused'),
				'phone.size' => 'Số điện thoại phải có đúng 10 chữ số.',
				'password.required' => 'Mật khẩu là cần thiết!!!',
				'password.min' => 'Để an toàn hơn, hãy đặt mật khẩu từ 6 kí tự trở lên.',
				// 'password_confirmation.required' => 'Cần phải nhập lại mật khẩu.',
				// 'password_confirmation.same' => 'Nhập lại mật khẩu sai, chắc chưa?',
			]);
			User::create([
				'name' => $request->input('name'),
				'phone' => $request->input('phone'),
				'password' => Hash::make($request->input('password')),
			]);
			return redirect()->route('admin.account')->withErrors(['success' => 'Tạo tài khoản thành công.']);
		} else {
			return $this->rejectAction();
		}
	}

	public function edit($id)
	{
		$check = $this->checkRootUser($this->getCurrentId());
		if ($check) {
			//do something if the User is ROOT
			// $admin = Admin::find($id);
			$admin = Admin::find($id);
			if ($admin)
				return view('admin.layouts.edit', [
					'admin' => $admin,
					'title' => 'Thay đổi thông tin tài khoản ' . $admin->name,
					'formView' => 'admin.manager.hr.hrEditForm',
				]);
			else return back()->withErrors(['warning' => 'Khong tim thay ID']);
		} else {
			return $this->rejectAction();
		}
	}

	public function update(Request $request, $id)
	{
		$check = $this->checkRootUser($this->getCurrentId());
		if ($check) {
			//do something if the User is ROOT
			// Ngăn ngừa tấn công CSRF
			$this->invokeCsrfGuard();

			// Kiểm tra xem id có tồn tại hay không?
			$admin = Admin::find($id);
			if ($admin) {
				$admin->timestamps = false;
				$prop = 0;
				if ($request->boolean('name_check')) {
					$request->validate(['name' => 'required|string|max:255']);
					$admin->name = $request->input('name');
					$prop++;
				}
				if ($request->boolean('phone_check')) {
					if ($request->input('phone') != $admin->phone) {
						$request->validate(
							[
								'phone' => 'required|string|digits:10|unique:admins',
							],
							[
								'phone.unique' => 'Số điện thoại đã được sử dụng ở tài khoản khác.',
								'phone.digits' => 'Điện thoại có đủ 10 chữ số.'
							]
						);
						$admin->phone = $request->input('phone');
						$prop++;
					}
				}
				if ($request->boolean('password_check')) {

					$request->validate(['password' => 'required|min:6']);
					$admin->password = Hash::make($request->input('password'));
					$prop++;
				}

				$admin->save();
				return redirect()->route('admin.hr')->withErrors(([
					'success' => numToText($prop) . ' thuộc tính đã được cập nhật.'
				]));
			} else return back()->withErrors(['warning' => 'Không tìm thấy ID.']);
		} else {
			return $this->rejectAction();
		}
	}

	public function destroy($id)
	{
		$check = $this->checkRootUser($this->getCurrentUser());
		if ($check) {
			unset($check);
			//do something if the User is ROOT
			// Ngăn ngừa tấn công CSRF
			$this->invokeCsrfGuard();

			// Kiểm tra xem id có tồn tại hay không?
			$admin = Admin::find($id);
			if (!$admin) {
				return back()->withErrors([
					'warning' =>trans('admin.account.message.cannotfinduser', ['id' => $id]),
				]);
			}

			// Không thể xóa tk ROOT:
			if ($admin->id == 1) {
				return back()->withErrors([
					'danger' => trans('admin.account.message.cannotdeleterootaccount'),
				]);
			}

			// Thực hiện xóa contact...
			$admin->delete();
			return redirect()->route('admin.hr')->withErrors(([
				'success' => 'Đã xóa thành công ' . $admin->name . '.'
			]));
		} else {
			unset($check);
			return $this->rejectAction();
		}
	}

	public function grantAccess($userid, $permission)
	{
		if(HomeController::checkRootUser()){
			$user = User::find($userid);
			if(!$user)  return [
				false, 
				trans('admin.account.message.cannotfinduser', ['id'=>$userid])
			];
			if($user->name == 'ROOT') return [
				false,
				trans('admin.account.message.cannotoperateonroot')
			];
			if((AccessPermissions::isValidName($permission)) && ($user)){
				$user->role = strtoupper($permission);
				$user->save();
				return [true, trans('admin.account.message.successfulgrantaccess')];
			} else return [false, trans('admin.account.message.invalidpermission')];
		}else{
			return $this->rejectAction();
		}
	}

	public function requestGrantAccess(Request $request){
		HomeController::checkRootUser();
		$id = $request->id;
		$per = $request->permission;
		[$check, $message] = ($this->grantAccess($id, $per));
		if($check) return redirect()->route('admin.account')->withErrors(['success'=>$message]);
		else return redirect()->back()->withErrors(['danger'=>$message]);
	}

	public function changePassword($id, $newpassword){
		try {
			$user = User::find($id);
			$user->password = Hash::make($newpassword);
			$user->save();
			return [true, trans('admin.account.message.successfulchangepassword')];
		} catch (\Exception $e) {
			return [false, trans('admin.account.message.errorchangepassword').': '.$e->getMessage()];
		}
	}

	public function requestChangePassword(Request $request){
		HomeController::checkRootUser();
		if($user = User::find($request->id)){
			$request->validate([
				'id' => 'required|exists:users,id',
				'newpassword' => 'required|string|min:6',
			]);

			if(HomeController::checkGrandRootUser(1)){
			}else{
				if($request->id == 1) return back()->withErrors(['danger' => trans('admin.account.message.cannotoperateonroot') ]);
				$request->validate([
					'oldpassword' => 'required',
					'confirmpassword' => 'required|string|same:newpassword',
				]);
				if(!Hash::check($request->oldpassword, $user->password)){
					return back()->withErrors(['danger' => trans('admin.account.message.oldpasswordincorrect') ]);
				}
			}
			
			[$check, $message] = $this->changePassword($request->id,$request->newpassword);
			if($check) return redirect()->route('admin.account')->withErrors(['success'=>$message]);
			else return redirect()->back()->withErrors(['danger'=>$message]);
			
		} else {
			return back()->withErrors([
				'warning' => trans('admin.account.message.cannotfinduser', ['id' => $request->id])
			]);
		}
	}

	public function search(Request $request)
	{
		if ($request->ajax() !== NULL) {
			return Response(
				json_encode(
					DB::table('admins')
						->where('name', 'LIKE', '%' . $request->search . '%')
						->get()
				)
			);
		}
	}
}
