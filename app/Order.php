<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany('App\OrdersProduct', 'order_id');
    }

    /**
     * @param $orderId
     * @return mixed
     */
    public static function getOrderDetails($orderId) {
        $getOrderDetails = Order::where('id', $orderId)->first();
        return $getOrderDetails;
    }

    /**
     * @param $country
     * @return mixed
     */
    public static function getCountryCode($country) {
        $getCountryCode = Country::where('name', $country)->first();
        return $getCountryCode;
    }
}
