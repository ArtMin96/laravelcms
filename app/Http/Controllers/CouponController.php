<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Validator;

class CouponController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addCoupon(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $validate = Validator::make($data, [
                'coupon_code' => 'required|min:5|max:15',
                'amount' => 'required|numeric|min:0',
                'amount_type'  => 'required',
                'expiry_date'  => 'required',
            ]);

            if($validate->passes()) {
                $coupon = new Coupon;
                $coupon->coupon_code = $data['coupon_code'];
                $coupon->amount = $data['amount'];
                $coupon->amount_type = $data['amount_type'];
                $coupon->expiry_date = $data['expiry_date'];
                if (empty($data['status'])) {
                    $data['status'] = 0;
                }
                $coupon->status = $data['status'];
                $coupon->save();

                return redirect()->action('CouponController@viewCoupons')->with('flash_message_success', 'Coupon has been added.');
            }
        }
        return view('admin.coupons.add_coupon');
    }

    public function editCoupon(Request $request, $id = null) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'coupon_code' => 'required|min:5|max:15',
                'amount' => 'required|numeric|min:0',
                'amount_type'  => 'required',
                'expiry_date'  => 'required',
            ]);

            if($validate->passes()) {
                $coupon = Coupon::find($id);
                $coupon->coupon_code = $data['coupon_code'];
                $coupon->amount = $data['amount'];
                $coupon->amount_type = $data['amount_type'];
                $coupon->expiry_date = $data['expiry_date'];
                if (empty($data['status'])) {
                    $data['status'] = 0;
                }
                $coupon->status = $data['status'];
                $coupon->save();

                return redirect()->action('CouponController@viewCoupons')->with('flash_message_success', 'Coupon has been updated.');
            }
        }
        $couponDetails = Coupon::find($id);
        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }

    public function deleteCoupon($id) {
        Coupon::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Coupon has been deleted.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCoupons() {
        $coupons = Coupon::get();
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }
}
