<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
use Validator;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])) {
//                Session::put('adminSession', $data['email']);
                return redirect('/admin/dashboard');
            } else {
                return redirect('/admin')->with('flash_message_error', 'Invalid Email or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings() {
        return view('admin.settings');
    }

    /**
     * @param Request $request
     */
    public function chkPassword(Request $request) {
        $data = $request->all();
        $currentPassword = $data['currentPwd'];
        $checkPassword = User::where(['admin' => '1'])->first();

        if(!empty($currentPassword)) {
            if(Hash::check($currentPassword, $checkPassword->password)) {
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'empty';
        }
    }

    public function updatePassword(Request $request) {
        if($request->isMethod('get')) {
            $data = $request->all();

            $checkPassword = User::where(['email' => Auth::user()->email])->first();
            $currentPassword = $data['currentPwd'];
            $confirmPassword = $data['confirmPwd'];

            $validate = Validator::make($data, [
                'newPwd' => 'required|min:6|required_with:confirmPwd|same:confirmPwd',
                'confirmPwd' => ''
            ]);

            if($validate->passes()) {
                if(Hash::check($currentPassword, $checkPassword->password)) {
                    $password = bcrypt($data['newPwd']);
                    User::where('id', '1')->update(['password' => $password]);
                    return response()->json(['flash_message_success' => 'Password updated successfully!']);
                } else {
                    return response()->json(['flash_message_error' => 'Incorrect Current Password!']);
                }
            } else {
                return response()->json(['flash_message_error' => $validate->errors()->all()]);
            }
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out successfully');
    }
}
