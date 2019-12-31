@extends('layouts.frontLayout.front_design')

@section('content')
    <div class="container py-4 py-lg-5 my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <h2 class="h4 mb-1">Sign in</h2>
                        <div class="py-3">
                            <h3 class="d-inline-block align-middle font-size-base font-weight-semibold mb-2 mr-2">With social account:</h3>
                            <div class="d-inline-block align-middle"><a class="social-btn sb-google mr-2 mb-2" href="#" data-toggle="tooltip" title="Sign in with Google"><i class="czi-google"></i></a><a class="social-btn sb-facebook mr-2 mb-2" href="#" data-toggle="tooltip" title="Sign in with Facebook"><i class="czi-facebook"></i></a><a class="social-btn sb-twitter mr-2 mb-2" href="#" data-toggle="tooltip" title="Sign in with Twitter"><i class="czi-twitter"></i></a></div>
                        </div>
                        <hr>
                        <h3 class="font-size-base pt-4 pb-2">Or using form below</h3>
                        <form class="needs-validation" action="{{ url('/account-login') }}" id="loginForm" name="loginForm" method="POST" novalidate>
                            {{ csrf_field() }}
                            <div class="input-group-overlay form-group">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-mail"></i></span></div>
                                <input class="form-control prepended-form-control" type="email" name="email" placeholder="Email" value="{!! old('email') !!}">
                            </div>
                            <div class="input-group-overlay form-group">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-locked"></i></span></div>
                                <div class="password-toggle">
                                    <input class="form-control prepended-form-control" type="password" name="password" placeholder="Password">
                                    <label class="password-toggle-btn">
                                        <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" checked id="remember_me">
                                    <label class="custom-control-label" for="remember_me">Remember me</label>
                                </div><a class="nav-link-inline font-size-sm" href="account-password-recovery.html">Forgot password?</a>
                            </div>
                            <hr class="mt-4">
                            <div class="text-right pt-4">
                                <button class="btn btn-primary" type="submit"><i class="czi-sign-in mr-2 ml-n21"></i>Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pt-4 mt-3 mt-md-0">
                <h2 class="h4 mb-3">No account? Sign up</h2>
                <p class="font-size-sm text-muted mb-4">Registration takes less than a minute but gives you full control over your orders.</p>
                <form class="needs-validation" action="{{ url('/account-register') }}" id="registerForm" name="registerForm" method="POST" novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="reg-fn">Full Name</label>
                                <input class="form-control" type="text" name="name" value="{!! old('name') !!}" id="reg-fn">
                                <div class="invalid-feedback">Please enter your full name!</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="reg-email">E-mail Address</label>
                                <input class="form-control" type="email" name="email" value="{!! old('email') !!}" id="reg-email">
                                <div class="invalid-feedback">Please enter valid email address!</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-password">Password</label>
                                <input class="form-control" type="password" name="password" id="reg-password">
                                <div class="invalid-feedback">Please enter password!</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-password-confirm">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" id="reg-password-confirm">
                                <div class="invalid-feedback">Passwords do not match!</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit"><i class="czi-user mr-2 ml-n1"></i>Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
