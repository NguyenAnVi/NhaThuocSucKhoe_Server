<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminCustomerController extends Controller
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
		$users = DB::table('users')->paginate(5);
		$newdata = ([
			'collection' => $users,
			'title' => 'Danh sách các tài khoản KH',
			'tableView' => 'admin.manager.customer.customerTable',
		]);
		if ($check) {
			if ($olddata != NULL)
				$data = array_merge($olddata, $newdata);
			else
				$data = $newdata;
			return view('admin.layouts.index', $data);
		} else {
			return $this->rejectAction();
		}
	}

	public function edit($id)
	{
		$check = $this->checkRootUser($this->getCurrentId());
		if ($check) {
			//do something if the User is ROOT
			$user = User::where('id', $id)->first();
			if ($user)
				return view('admin.layouts.edit', [
					'user' => $user,
					'title' => 'Thay đổi thông tin tài khoản ' . $user->name,
					'formView' => 'admin.manager.customer.customerEditForm',
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
			$user = User::find($id);
			if (!$user) {
				return back()->withErrors([
					'warning' => 'Không tìm thấy ID',
				]);
			} else {
				$user->timestamps = false;
				$prop = 0;
				if ($request->boolean('name_check')) {
					$request->validate(['name' => 'required|string|max:255']);
					$user->name = $request->input('name');
					$prop++;
				}
				if ($request->boolean('phone_check')) {
					if ($request->input('phone') != $user->phone) {
						$request->validate(['phone' => 'required|string|max:10|min:10|unique:admins']);
						$user->phone = $request->input('phone');
						$prop++;
					}
				}
				if ($request->boolean('password_check')) {
					$request->validate(['password' => 'required|min:6']);
					$user->password = Hash::make($request->input('password'));
					$prop++;
				}

				$user->save();
				return redirect()->route('admin.customer')->withErrors(([
					'success' => numtoText($prop) . ' thuộc tính đã được cập nhật.'
				]));
			}
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
			$user = User::find($id);
			if (!$user) {
				$this->notFound();
			}

			// Thực hiện xóa contact...
			$user->delete();
			return redirect()->route('admin.customer')->withErrors(([
				'success' => 'Đã xóa thành công ' . $user->name . '.'
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
					DB::table('users')
						->where('name', 'LIKE', '%' . $request->search . '%')
						->get()
				)
			);
		}
	}
}
