<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminHRController extends Controller
{
	public function getCurrentId()
	{
		return Auth::guard('admin')->user()->id;
	}

	public function rejectAction()
	{
		//return an message reject permision to a page
		$data = ([
			'danger' => 'Tài khoản không đủ quyền thực hiện hành động này.',
		]);
		return redirect()->route('admin.home')->withErrors($data);
	}
	public function checkRootUser($id)
	{
		if ($id === 1) {
			return true;
		} else {
			return false;
		}
	}
	/////////////////// using checkRootUser/////////////////
	// $check = $this->checkRootUser($this->getCurrentId());
	// if($check){
	//     //do something if the User is ROOT
	// }
	// else{
	//     return $this->rejectAction();
	// }
	//////////////////////////////////////////////////////////

	public function index($olddata = NULL)
	{
		$check = $this->checkRootUser($this->getCurrentId());
		$admins = DB::table('admins')->paginate(5);
		$newdata = ([
			'collection' => $admins,
			'title' => 'Danh sách tài khoản admin',
			'createRoute' => route('admin.hr.create'),
			'tableView' => 'admin.manager.hr.hrTable'
		]);
		if ($check) {
			if ($olddata != NULL) $data = array_merge($olddata, $newdata);
			else $data = ($newdata);
			return view('admin.layouts.index', $data);
		} else {
			return $this->rejectAction();
		}
	}

	public function create()
	{
		$check = $this->checkRootUser($this->getCurrentId());
		if ($check) {
			return view('admin.layouts.create', [
				'title' => 'Thêm tài khoản admin',
				'formView' => 'admin.manager.hr.hrAddForm',
			]);
		} else {
			return $this->rejectAction();
		}
	}

	public function store(Request $request)
	{
		$check = $this->checkRootUser($this->getCurrentId());
		if ($check) {
			//if the User is ROOT
			$request->only(['name', 'phone', 'password', 'password_confirm']);
			$request->validate([
				'name' => 'required|string|max:255',
				'phone' => 'required|string|size:10|unique:admins',
				'password' => 'required|min:6',
				'password_confirmation' => 'required|same:password'
			], $messages = [
				'name.required' => 'Bạn cần nhập tên',
				'name.max' => 'Tên nhân viên không vượt quá :max kí tự.',
				'phone.unique' => 'Số điện thoại đã tồn tại.',
				'phone.size' => 'Số điện thoại phải có đúng 10 chữ số.',
				'password.required' => 'Mật khẩu là cần thiết!!!',
				'password.min' => 'Để an toàn hơn, hãy đặt mật khẩu từ 6 kí tự trở lên.',
				'password_confirmation.required' => 'Cần phải nhập lại mật khẩu.',
				'password_confirmation.same' => 'Nhập lại mật khẩu sai, chắc chưa?',
			]);
			Admin::create([
				'name' => $request->input('name'),
				'phone' => $request->input('phone'),
				'password' => Hash::make($request->input('password')),
			]);
			return redirect()->route('admin.hr')->withErrors(['success' => 'Tạo tài khoản thành công.']);
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
		$check = $this->checkRootUser($this->getCurrentId());
		if ($check) {
			unset($check);
			//do something if the User is ROOT
			// Ngăn ngừa tấn công CSRF
			$this->invokeCsrfGuard();

			// Kiểm tra xem id có tồn tại hay không?
			$admin = Admin::find($id);
			if (!$admin) {
				return back()->withErrors([
					'warning' => 'Không tìm thấy người dùng có mã ' . $id
				]);
			}

			// Không thể xóa tk ROOT:
			if ($admin->id == 1) {
				return back()->withErrors([
					'danger' => 'Không thể xóa tài khoản quản trị.',
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
