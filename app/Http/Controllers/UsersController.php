<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function memberLoginRegister() {
        return view('members.account_login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                Session::put('frontSession', $data['email']);

                if (!empty(Session::get('session_id'))) {
                    $sessionId = Session::get('session_id');
                    DB::table('cart')->where('session_id', $sessionId)->update(['user_email' => $data['email']]);
                }

                return redirect('/cart')->with('flash_message_success', 'You are successfully logged in');
            } else {
                return redirect()->back()->with('flash_message_error', 'Invalid Email or Password.');
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function register(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'name' => 'required|string|min:2|max:50',
                'email' => 'required|email',
                'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => ''
            ]);

            if ($validate->passes()) {
                // Check if user already exists
                $userCheck = User::where('email', $data['email'])->count();
                if($userCheck > 0) {
                    return redirect()->back()->with('flash_message_error', $data['email'].' already exists.');
                } else {
                    $user = new User;
                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->password = bcrypt($data['password']);
                    $user->save();

                    if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                        Session::put('frontSession', $data['email']);

                        if (!empty(Session::get('session_id'))) {
                            $sessionId = Session::get('session_id');
                            DB::table('cart')->where('session_id', $sessionId)->update(['user_email' => $data['email']]);
                        }

                        return redirect('/cart')->with('flash_message_success', 'You are successfully logged in');
                    }
                }
            } else {
                return redirect('account-auth')->with('flash_message_validation_error', $validate->errors()->all())->withInput();
            }

        }
        return view('members.account_login');
    }

    /**
     * @param Request $request
     */
    public function checkUserPassword(Request $request) {
        $data = $request->all();
        $currentPassword = $data['currentPassword'];

        $userId = Auth::user()->id;
        $checkPassword = User::where('id', $userId)->first();
        if(Hash::check($currentPassword, $checkPassword->password)) {
            echo 'true'; die;
        } else {
            echo 'false'; die;
        }
    }

    public function updatePassword(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'new_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => ''
            ]);

            if($validate->passes()) {
                $oldPassword = User::where('id', Auth::user()->id)->first();
                $currentPassword = $data['current_password'];

                if(Hash::check($currentPassword, $oldPassword->password)) {
                    // Update password
                    $newPassword = bcrypt($data['new_password']);
                    User::where('id', Auth::user()->id)->update(['password' => $newPassword]);
                    return redirect()->back()->with('flash_message_success', 'Password updated successfully.');
                } else {
                    return redirect()->back()->with('flash_message_error', 'Current password is incorrect.');
                }
            } else {
                return redirect()->back()->with('flash_message_validation_error', $validate->errors()->all());
            }
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/')->with('flash_message_success', 'You have been successfully logged out!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function account(Request $request) {
        $userId = Auth::user()->id;
        $userDetails = User::find($userId);
        $countries = Country::get();

        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['name'])) {
                return redirect()->back()->with('flash_message_error', 'Please enter your Name!');
            }
            $user = User::find($userId);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->address_opt = $data['address_opt'];
            $user->phone = $data['phone'];
            $user->phone_opt = $data['phone_opt'];
            $user->country = $data['country'];
            $user->state = $data['state'];
            $user->city = $data['city'];
            $user->pincode = $data['pincode'];
            $user->save();

            return redirect()->back()->with('flash_message_success', 'Your account details has been successfully updated.');
        }
        return view('members.account')->with(compact('countries', 'userDetails'));
    }
}
