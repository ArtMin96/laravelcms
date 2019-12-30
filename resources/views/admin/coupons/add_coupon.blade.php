@extends('layouts.adminLayout.admin_design')
@section('loadCss')
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
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
                <div class="card">
                    @if(Session::has('flash_message_error'))
                        @foreach(Session::get('flash_message_error') as $error)
                            <div class="alert alert-danger" role="alert">
                                {!! $error !!}
                            </div>
                        @endforeach
                    @endif
                    @if(Session::has('flash_message_success'))
                        <div class="alert alert-success" role="alert">
                            {!! session('flash_message_success') !!}
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{ url('/admin/add-coupon') }}" method="post" name="add_coupon" id="add_coupon">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <h4 class="card-title">Add Coupon</h4>

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" value="1">
                                        <label class="custom-control-label" for="status"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expiry_date" class="col-sm-3 text-right control-label col-form-label">Expiry</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="mm-dd-yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="coupon_code" class="col-sm-3 text-right control-label col-form-label">Coupon Code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="coupon_code" class="form-control" id="coupon_code" placeholder="Coupon Code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount_type" class="col-sm-3 text-right control-label col-form-label">Amount Type</label>
                                <div class="col-sm-9">
                                    <select name="amount_type" class="form-control" id="amount_type">
                                        <option value="Percentage">Percentage</option>
                                        <option value="Fixed">Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" name="amount" class="form-control" id="amount" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection
@section('loadScript')
    <script src="{{ asset('backend/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#expiry_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
