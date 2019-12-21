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
        <div class="col-md-6">
            <div class="card">
                <div class="alert alert-danger d-none" id="changePwd-error" role="alert">
                    <ul class="list-unstyled"></ul>
                </div>
                <div class="alert alert-success d-none" id="changePwd-success" role="alert">
                    <ul class="list-unstyled"></ul>
                </div>
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('flash_message_error') !!}
                    </div>
                @endif
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success" role="alert">
                        {!! session('flash_message_success') !!}
                    </div>
                @endif
                <form class="form-horizontal" action="{{ url('/admin/update-pwd') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        <div class="form-group row">
                            <label for="current_pwd" class="col-sm-3 text-right control-label col-form-label">Curent Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_pwd" onkeyup="laravelCms.checkCurrentPwd()" class="form-control" id="current_pwd" placeholder="Curent Password">
                                <div class="invalid-feedback" id="invalid_current_pwd"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_pwd" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_pwd" class="form-control" id="new_pwd" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="button" onclick="laravelCms.updatePassword()" class="btn btn-primary">Save Changes</button>
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
