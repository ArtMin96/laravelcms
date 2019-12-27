<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LaravelCMS | eCommerce
    </title>
    <!-- SEO Meta Tags-->
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
