<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LaravelCMS | eCommerce
    </title>
    <!-- SEO Meta Tags-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="LaravelCMS | eCommerce">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Arthur Minasyan">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ asset('frontend/css/vendor.min.css') }}">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" id="main-styles" href="{{ asset('frontend/css/theme.min.css') }}">
    @yield('loadCss')
</head>
<body>
@include('layouts.frontLayout.front_header')
@yield('content')
@if(Session::has('flash_message_success'))
    <div class="toast-container toast-bottom-left">
        <div class="toast"  id="message-toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000">
            <div class="toast-header bg-success text-white">
                <i class="czi-check-circle mr-2"></i>
                <span class="font-weight-medium mr-auto">Success</span>
                <button type="button" class="close text-white ml-2 mb-1" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body text-success">{!! session('flash_message_success') !!}</div>
        </div>
    </div>
@endif

@if(Session::has('flash_message_error'))
    <div class="toast-container toast-bottom-left">
        <div class="toast" id="message-toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000">
            <div class="toast-header bg-danger text-white">
                <i class="czi-check-circle mr-2"></i>
                <span class="font-weight-medium mr-auto">Warning</span>
                <button type="button" class="close text-white ml-2 mb-1" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body text-danger">{!! session('flash_message_error') !!}</div>
        </div>
    </div>
@endif

@if(Session::has('flash_message_validation_error'))
    @foreach(Session::get('flash_message_validation_error') as $error)
        <div class="toast-container toast-bottom-left">
            <div class="toast" id="message-toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000">
                <div class="toast-header bg-danger text-white">
                    <i class="czi-check-circle mr-2"></i>
                    <span class="font-weight-medium mr-auto">Warning</span>
                    <button type="button" class="close text-white ml-2 mb-1" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body text-danger">{!! $error !!}</div>
            </div>
        </div>
    @endforeach
@endif

@if(Session::has('flash_message_warning'))
    <div class="toast-container toast-bottom-left">
        <div class="toast"  id="message-toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000">
            <div class="toast-header bg-info text-white">
                <i class="czi-check-circle mr-2"></i>
                <span class="font-weight-medium mr-auto">Note</span>
                <button type="button" class="close text-white ml-2 mb-1" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body text-info">{!! session('flash_message_warning') !!}</div>
        </div>
    </div>
@endif
@include('layouts.frontLayout.front_footer')
<!-- Back To Top Button-->
<a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon czi-arrow-up">   </i></a>
<!-- JavaScript libraries, plugins and custom scripts-->
<script src="{{ asset('frontend/js/vendor.min.js') }}"></script>
<script src="{{ asset('frontend/js/theme.min.js') }}"></script>
<script src="{{ asset('frontend/js/laravelCMS.js') }}"></script>
@yield('loadScript')
</body>
</html>
