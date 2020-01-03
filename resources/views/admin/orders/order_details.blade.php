@extends('layouts.adminLayout.admin_design')
@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="py-3 my-3">Order #{{ $orderDetails->id }}</h1>
                <hr>
            </div>
            @if(Session::has('flash_message_success'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {!! session('flash_message_success') !!}
                    </div>
                </div>
            @endif
            @if(Session::has('flash_message_error'))
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        {!! session('flash_message_error') !!}
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2">Order Details</th>
                    </tr>
                    </thead>
                    <tbody class="bg-light">
                        <tr>
                            <td>Order Date</td>
                            <td>{{ $orderDetails->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td>{{ $orderDetails->order_status }}</td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>{{ $orderDetails->grand_total }}</td>
                        </tr>
                        <tr>
                            <td>Shipping Charges</td>
                            <td>$ {{ $orderDetails->shipping_charges }}</td>
                        </tr>
                        <tr>
                            <td>Coupon Code</td>
                            <td>
                                @if(!empty($orderDetails->coupon_code))
                                    {{ $orderDetails->coupon_code }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Coupon Amount</td>
                            <td>$
                                @if(!empty($orderDetails->coupon_amount))
                                    {{ $orderDetails->coupon_amount }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>{{ $orderDetails->payment_method }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2">Customer Details</th>
                    </tr>
                    </thead>
                    <tbody class="bg-light">
                    <tr>
                        <td>Customer Name</td>
                        <td>{{ $orderDetails->name }}</td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td>{{ $orderDetails->user_email }}</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Change Order Status</th>
                        </tr>
                    </thead>

                    <tbody class="bg-light">
                        <tr>
                            <td>
                                <form action="{{ url('admin/update-order-status') }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                                    <div class="form-group">
                                        <select name="order_status" id="order_status" class="form-control w-100 mr-3">
                                            <option value="New" @if($orderDetails->order_status == 'New') selected @endif>New</option>
                                            <option value="Pending" @if($orderDetails->order_status == 'Pending') selected @endif>Pending</option>
                                            <option value="Cancelled" @if($orderDetails->order_status == 'Cancelled') selected @endif>Cancelled</option>
                                            <option value="In Process" @if($orderDetails->order_status == 'In Process') selected @endif>In Process</option>
                                            <option value="Shipped" @if($orderDetails->order_status == 'Shipped') selected @endif>Shipped</option>
                                            <option value="Delivered" @if($orderDetails->order_status == 'Delivered') selected @endif>Delivered</option>
                                            <option value="Paid" @if($orderDetails->order_status == 'Paid') selected @endif>Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Save">
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2">Billing Address</th>
                    </tr>
                    </thead>
                    <tbody class="bg-light">
                    <tr>
                        <td>Full Name</td>
                        <td>{{ $userDetails->name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $userDetails->phone }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $userDetails->address }}</td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td>{{ $userDetails->pincode }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $userDetails->city }}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{ $userDetails->state }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $userDetails->country }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2">Shipping Address</th>
                    </tr>
                    </thead>
                    <tbody class="bg-light">
                    <tr>
                        <td>Full Name</td>
                        <td>{{ $orderDetails->name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $orderDetails->phone }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $orderDetails->address }}</td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td>{{ $orderDetails->pincode }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $orderDetails->city }}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{ $orderDetails->state }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $orderDetails->country }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-2">Ordered Products</h3>
                <table class="table table-bordered">
                    <thead>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody class="bg-light">
                        @foreach($orderDetails->orders as $products)
                            <tr>
                                <td>{{ $products->product_code }}</td>
                                <td>{{ $products->product_name }}</td>
                                <td>{{ $products->product_size }}</td>
                                <td>{{ $products->product_price }}</td>
                                <td>{{ $products->product_qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
