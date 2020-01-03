@extends('layouts.frontLayout.front_design')

@section('content')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Account</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Orders history</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">My orders</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-3">
        <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0">
                <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
                    <div class="px-4 mb-4">
                        <div class="media align-items-center">
                            <div class="media-body pl-3">
                                <h3 class="font-size-base mb-0">{{ Auth::user()->name }}</h3><span class="text-accent font-size-sm">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="font-size-sm mb-0 text-muted">Dashboard</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="account-orders.html"><i class="czi-bag opacity-60 mr-2"></i>Orders<span class="font-size-sm text-muted ml-auto">1</span></a></li>
                        <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-wishlist.html"><i class="czi-heart opacity-60 mr-2"></i>Wishlist<span class="font-size-sm text-muted ml-auto">3</span></a></li>
                        <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-tickets.html"><i class="czi-help opacity-60 mr-2"></i>Support tickets<span class="font-size-sm text-muted ml-auto">1</span></a></li>
                    </ul>
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-profile.html"><i class="czi-user opacity-60 mr-2"></i>Profile info</a></li>
                        <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-address.html"><i class="czi-location opacity-60 mr-2"></i>Addresses</a></li>
                        <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-payment.html"><i class="czi-card opacity-60 mr-2"></i>Payment methods</a></li>
                        <li class="d-lg-none border-top mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html"><i class="czi-sign-out opacity-60 mr-2"></i>Sign out</a></li>
                    </ul>
                </div>
            </aside>
            <!-- Content  -->
            <section class="col-lg-8">
                <!-- Toolbar-->
                <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                    <div class="form-inline">
                        <label class="text-light opacity-75 text-nowrap mr-2 d-none d-lg-block" for="order-sort">Sort orders:</label>
                        <select class="form-control custom-select" id="order-sort">
                            <option>All</option>
                            <option>Delivered</option>
                            <option>In Progress</option>
                            <option>Delayed</option>
                            <option>Canceled</option>
                        </select>
                    </div><a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="account-signin.html"><i class="czi-sign-out mr-2"></i>Sign out</a>
                </div>
                <!-- Orders list-->
                <div class="table-responsive font-size-md">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Ordered Products</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Created on</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details-{{ $order->id }}" data-toggle="modal">{{ $order->id }}</a></td>
                                    <td class="py-3">

                                        <div class="modal fade" id="order-details-{{ $order->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Order No - 34VB5540K83</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body pb-0">
                                                        <!-- Item-->
                                                        @foreach($order->orders as $products)
                                                            <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                                                                <div class="media d-block d-sm-flex text-center text-sm-left">
                                                                    <div class="media-body pt-2">
                                                                        <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">{{ $products->product_name }}</a></h3>
                                                                        <div class="font-size-sm"><span class="text-muted mr-2">Code:</span>{{ $products->product_code }}</div>
                                                                        <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>{{ $products->product_size }}</div>
                                                                        <div class="font-size-lg text-accent pt-2">${{ $products->product_price }}</div>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                                                                    <div class="text-muted mb-2">Quantity:</div>{{ $products->product_qty }}
                                                                </div>
                                                                <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                                                                    <div class="text-muted mb-2">Subtotal</div>$154.<small>00</small>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="py-3">{{ $order->payment_method }}</td>
                                    <td class="py-3">{{ $order->grand_total }}</td>
                                    <td class="py-3">{{ $order->created_at }}</td>
                                    <td class="py-3"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr class="pb-4">
                <!-- Pagination-->
                <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="czi-arrow-left mr-2"></i>Prev</a></li>
                    </ul>
                    <ul class="pagination">
                        <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                        <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="sr-only">(current)</span></span></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                    </ul>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i class="czi-arrow-right ml-2"></i></a></li>
                    </ul>
                </nav>
            </section>
        </div>
    </div>
@endsection
