@extends('layouts.frontLayout.front_design')
@section('content')
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="#">Shop</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Grid left sidebar</li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0">{{ $categoryDetails->name }}</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-4">
            <!-- Sidebar-->
            <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar">
                <div class="cz-sidebar-header box-shadow-sm">
                    <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
                </div>
                <div class="cz-sidebar-body" data-simplebar data-simplebar-auto-hide="true">
                    <!-- Categories-->
                    <div class="widget widget-categories mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Categories</h3>
                        <div class="accordion mt-n1" id="shop-categories">
                            <!-- Categories-->
                            @if(!$categories->isEmpty())
                                @foreach($categories as $category)
                                    @if($category->status == '1')
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="accordion-heading">
                                                    <a class="collapsed" href="#category-{{ $category->id }}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="category-{{ $category->id }}">{{ $category->name }}<span class="accordion-indicator"></span></a>
                                                </h3>
                                            </div>
                                            <div class="collapse" id="category-{{ $category->id }}" data-parent="#shop-categories">
                                                <div class="card-body">
                                                    <div class="widget widget-links cz-filter">
                                                        <div class="input-group-overlay input-group-sm mb-2">
                                                            <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="Search">
                                                            <div class="input-group-append-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
                                                        </div>
                                                        <ul class="widget-list cz-filter-list pt-1" style="height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                                                            @foreach($category->categories as $subCategory)
                                                                @if($subCategory->status == '1')
                                                                    <li class="widget-list-item cz-filter-item">
                                                                        <a class="widget-list-link d-flex justify-content-between align-items-center" href="{{ url('/products/'.$subCategory->url) }}">
                                                                            <span class="cz-filter-item-text">{{ $subCategory->name }}</span>
                                                                            <span class="font-size-xs text-muted ml-3">1,953</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="accordion-heading">No categories found</h3>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Price range-->
                    <div class="widget mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Price</h3>
                        <div class="cz-range-slider" data-start-min="250" data-start-max="680" data-min="0" data-max="1000" data-step="1">
                            <div class="cz-range-slider-ui"></div>
                            <div class="d-flex pb-1">
                                <div class="w-50 pr-2 mr-2">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input class="form-control cz-range-slider-value-min" type="text">
                                    </div>
                                </div>
                                <div class="w-50 pl-2">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input class="form-control cz-range-slider-value-max" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Filter by Brand-->
                    <div class="widget cz-filter mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Brand</h3>
                        <div class="input-group-overlay input-group-sm mb-2">
                            <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="Search">
                            <div class="input-group-append-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
                        </div>
                        <ul class="widget-list cz-filter-list list-unstyled pt-1" style="max-height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="adidas">
                                    <label class="custom-control-label cz-filter-item-text" for="adidas">Adidas</label>
                                </div><span class="font-size-xs text-muted">425</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ataylor">
                                    <label class="custom-control-label cz-filter-item-text" for="ataylor">Ann Taylor</label>
                                </div><span class="font-size-xs text-muted">15</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="armani">
                                    <label class="custom-control-label cz-filter-item-text" for="armani">Armani</label>
                                </div><span class="font-size-xs text-muted">18</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="banana">
                                    <label class="custom-control-label cz-filter-item-text" for="banana">Banana Republic</label>
                                </div><span class="font-size-xs text-muted">103</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="bilabong">
                                    <label class="custom-control-label cz-filter-item-text" for="bilabong">Bilabong</label>
                                </div><span class="font-size-xs text-muted">27</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="birkenstock">
                                    <label class="custom-control-label cz-filter-item-text" for="birkenstock">Birkenstock</label>
                                </div><span class="font-size-xs text-muted">10</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="klein">
                                    <label class="custom-control-label cz-filter-item-text" for="klein">Calvin Klein</label>
                                </div><span class="font-size-xs text-muted">365</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="columbia">
                                    <label class="custom-control-label cz-filter-item-text" for="columbia">Columbia</label>
                                </div><span class="font-size-xs text-muted">508</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="converse">
                                    <label class="custom-control-label cz-filter-item-text" for="converse">Converse</label>
                                </div><span class="font-size-xs text-muted">176</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="dockers">
                                    <label class="custom-control-label cz-filter-item-text" for="dockers">Dockers</label>
                                </div><span class="font-size-xs text-muted">54</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="fruit">
                                    <label class="custom-control-label cz-filter-item-text" for="fruit">Fruit of the Loom</label>
                                </div><span class="font-size-xs text-muted">739</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="hanes">
                                    <label class="custom-control-label cz-filter-item-text" for="hanes">Hanes</label>
                                </div><span class="font-size-xs text-muted">92</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="choo">
                                    <label class="custom-control-label cz-filter-item-text" for="choo">Jimmy Choo</label>
                                </div><span class="font-size-xs text-muted">17</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="levis">
                                    <label class="custom-control-label cz-filter-item-text" for="levis">Levi's</label>
                                </div><span class="font-size-xs text-muted">361</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="lee">
                                    <label class="custom-control-label cz-filter-item-text" for="lee">Lee</label>
                                </div><span class="font-size-xs text-muted">264</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="wearhouse">
                                    <label class="custom-control-label cz-filter-item-text" for="wearhouse">Men's Wearhouse</label>
                                </div><span class="font-size-xs text-muted">75</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="newbalance">
                                    <label class="custom-control-label cz-filter-item-text" for="newbalance">New Balance</label>
                                </div><span class="font-size-xs text-muted">218</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="nike">
                                    <label class="custom-control-label cz-filter-item-text" for="nike">Nike</label>
                                </div><span class="font-size-xs text-muted">810</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="navy">
                                    <label class="custom-control-label cz-filter-item-text" for="navy">Old Navy</label>
                                </div><span class="font-size-xs text-muted">147</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="polo">
                                    <label class="custom-control-label cz-filter-item-text" for="polo">Polo Ralph Lauren</label>
                                </div><span class="font-size-xs text-muted">64</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="puma">
                                    <label class="custom-control-label cz-filter-item-text" for="puma">Puma</label>
                                </div><span class="font-size-xs text-muted">370</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="reebok">
                                    <label class="custom-control-label cz-filter-item-text" for="reebok">Reebok</label>
                                </div><span class="font-size-xs text-muted">506</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="skechers">
                                    <label class="custom-control-label cz-filter-item-text" for="skechers">Skechers</label>
                                </div><span class="font-size-xs text-muted">209</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="hilfiger">
                                    <label class="custom-control-label cz-filter-item-text" for="hilfiger">Tommy Hilfiger</label>
                                </div><span class="font-size-xs text-muted">487</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="armour">
                                    <label class="custom-control-label cz-filter-item-text" for="armour">Under Armour</label>
                                </div><span class="font-size-xs text-muted">90</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="urban">
                                    <label class="custom-control-label cz-filter-item-text" for="urban">Urban Outfitters</label>
                                </div><span class="font-size-xs text-muted">152</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="vsecret">
                                    <label class="custom-control-label cz-filter-item-text" for="vsecret">Victoria's Secret</label>
                                </div><span class="font-size-xs text-muted">238</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="wolverine">
                                    <label class="custom-control-label cz-filter-item-text" for="wolverine">Wolverine</label>
                                </div><span class="font-size-xs text-muted">29</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="wrangler">
                                    <label class="custom-control-label cz-filter-item-text" for="wrangler">Wrangler</label>
                                </div><span class="font-size-xs text-muted">115</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Filter by Size-->
                    <div class="widget cz-filter mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Size</h3>
                        <div class="input-group-overlay input-group-sm mb-2">
                            <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="Search">
                            <div class="input-group-append-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
                        </div>
                        <ul class="widget-list cz-filter-list list-unstyled pt-1" style="max-height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-xs">
                                    <label class="custom-control-label cz-filter-item-text" for="size-xs">XS</label>
                                </div><span class="font-size-xs text-muted">34</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-s">
                                    <label class="custom-control-label cz-filter-item-text" for="size-s">S</label>
                                </div><span class="font-size-xs text-muted">57</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-m">
                                    <label class="custom-control-label cz-filter-item-text" for="size-m">M</label>
                                </div><span class="font-size-xs text-muted">198</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-l">
                                    <label class="custom-control-label cz-filter-item-text" for="size-l">L</label>
                                </div><span class="font-size-xs text-muted">72</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-xl">
                                    <label class="custom-control-label cz-filter-item-text" for="size-xl">XL</label>
                                </div><span class="font-size-xs text-muted">46</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-39">
                                    <label class="custom-control-label cz-filter-item-text" for="size-39">39</label>
                                </div><span class="font-size-xs text-muted">112</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-40">
                                    <label class="custom-control-label cz-filter-item-text" for="size-40">40</label>
                                </div><span class="font-size-xs text-muted">85</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-41">
                                    <label class="custom-control-label cz-filter-item-text" for="size-40">41</label>
                                </div><span class="font-size-xs text-muted">210</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-42">
                                    <label class="custom-control-label cz-filter-item-text" for="size-42">42</label>
                                </div><span class="font-size-xs text-muted">57</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-43">
                                    <label class="custom-control-label cz-filter-item-text" for="size-43">43</label>
                                </div><span class="font-size-xs text-muted">30</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-44">
                                    <label class="custom-control-label cz-filter-item-text" for="size-44">44</label>
                                </div><span class="font-size-xs text-muted">61</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-45">
                                    <label class="custom-control-label cz-filter-item-text" for="size-45">45</label>
                                </div><span class="font-size-xs text-muted">23</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-46">
                                    <label class="custom-control-label cz-filter-item-text" for="size-46">46</label>
                                </div><span class="font-size-xs text-muted">19</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-47">
                                    <label class="custom-control-label cz-filter-item-text" for="size-47">47</label>
                                </div><span class="font-size-xs text-muted">15</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-48">
                                    <label class="custom-control-label cz-filter-item-text" for="size-48">48</label>
                                </div><span class="font-size-xs text-muted">12</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-49">
                                    <label class="custom-control-label cz-filter-item-text" for="size-49">49</label>
                                </div><span class="font-size-xs text-muted">8</span>
                            </li>
                            <li class="cz-filter-item d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="size-50">
                                    <label class="custom-control-label cz-filter-item-text" for="size-50">50</label>
                                </div><span class="font-size-xs text-muted">6</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Filter by Color-->
                    <div class="widget">
                        <h3 class="widget-title">Color</h3>
                        <div class="d-flex flex-wrap">
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-blue-gray">
                                <label class="custom-option-label rounded-circle" for="color-blue-gray"><span class="custom-option-color rounded-circle" style="background-color: #b3c8db;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-blue-gray">Blue-gray</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-burgundy">
                                <label class="custom-option-label rounded-circle" for="color-burgundy"><span class="custom-option-color rounded-circle" style="background-color: #ca7295;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-burgundy">Burgundy</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-teal">
                                <label class="custom-option-label rounded-circle" for="color-teal"><span class="custom-option-color rounded-circle" style="background-color: #91c2c3;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-teal">Teal</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-brown">
                                <label class="custom-option-label rounded-circle" for="color-brown"><span class="custom-option-color rounded-circle" style="background-color: #9a8480;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-brown">Brown</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-coral-red">
                                <label class="custom-option-label rounded-circle" for="color-coral-red"><span class="custom-option-color rounded-circle" style="background-color: #ff7072;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-coral-red">Coral red</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-navy">
                                <label class="custom-option-label rounded-circle" for="color-navy"><span class="custom-option-color rounded-circle" style="background-color: #696dc8;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-navy">Navy</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-charcoal">
                                <label class="custom-option-label rounded-circle" for="color-charcoal"><span class="custom-option-color rounded-circle" style="background-color: #4e4d4d;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-charcoal">Charcoal</label>
                            </div>
                            <div class="custom-control custom-option text-center mb-2 mx-1" style="width: 4rem;">
                                <input class="custom-control-input" type="checkbox" id="color-sky-blue">
                                <label class="custom-option-label rounded-circle" for="color-sky-blue"><span class="custom-option-color rounded-circle" style="background-color: #8bcdf5;"></span></label>
                                <label class="d-block font-size-xs text-muted mt-n1" for="color-sky-blue">Sky blue</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Content  -->
        <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
                <div class="d-flex flex-wrap">
                    <div class="form-inline flex-nowrap mr-3 mr-sm-4 pb-3">
                        <label class="text-light opacity-75 text-nowrap mr-2 d-none d-sm-block" for="sorting">Sort by:</label>
                        <select class="form-control custom-select" id="sorting">
                            <option>Popularity</option>
                            <option>Low - Hight Price</option>
                            <option>High - Low Price</option>
                            <option>Average Rating</option>
                            <option>A - Z Order</option>
                            <option>Z - A Order</option>
                        </select><span class="font-size-sm text-light opacity-75 text-nowrap ml-2 d-none d-md-block">of 287 products</span>
                    </div>
                </div>
                <div class="d-flex pb-3"><a class="nav-link-style nav-link-light mr-3" href="#"><i class="czi-arrow-left"></i></a><span class="font-size-md text-light">1 / 5</span><a class="nav-link-style nav-link-light ml-3" href="#"><i class="czi-arrow-right"></i></a></div>
                <div class="d-none d-sm-flex pb-3"><a class="btn btn-icon nav-link-style bg-light text-dark disabled opacity-100 mr-2" href="#"><i class="czi-view-grid"></i></a><a class="btn btn-icon nav-link-style nav-link-light" href="shop-list-ls.html"><i class="czi-view-list"></i></a></div>
            </div>
            <!-- Products grid-->
            <div class="row mx-n2">
                <!-- Product-->
                @if(!empty(!$productsAll->isEmpty()))
                    @foreach($productsAll as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
                                    <i class="czi-heart"></i>
                                </button>
                                <a class="card-img-top d-block overflow-hidden" href="{{ url('/product/'.$product->id) }}"><img src="{{ asset('backend/images/products/small/'.$product->image) }}" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Sneakers &amp; Keds</a>
                                    <h3 class="product-title font-size-sm"><a href="{{ url('/product/'.$product->id) }}">{{ $product->name }}</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">${{ $product->price }}</span></div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden">
                                    <div class="text-center pb-2">
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-75">
                                            <label class="custom-option-label" for="s-75">7.5</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-80" checked>
                                            <label class="custom-option-label" for="s-80">8</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-85">
                                            <label class="custom-option-label" for="s-85">8.5</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-90">
                                            <label class="custom-option-label" for="s-90">9</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                            <hr class="d-sm-none">
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-12 col-sm-12 px-2 mb-4">
                        <h4 class="text-center">No products found</h4>
                    </div>
                @endif

            </div>
            <!-- Banner-->
            <div class="py-sm-2">
                <div class="d-sm-flex justify-content-between align-items-center bg-secondary overflow-hidden mb-4 rounded-lg">
                    <div class="py-4 my-2 my-md-0 py-md-5 px-4 ml-md-3 text-center text-sm-left">
                        <h4 class="font-size-lg font-weight-light mb-2">Converse All Star</h4>
                        <h3 class="mb-4">Make Your Day Comfortable</h3><a class="btn btn-primary btn-shadow btn-sm" href="#">Shop Now</a>
                    </div><img class="d-block ml-auto" src="img/shop/catalog/banner.jpg" alt="Shop Converse">
                </div>
            </div>
            <!-- Products grid-->
            <div class="row mx-n2">
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/07.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Women's Swimwear</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Two-Piece Bikini in Print</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$18.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size4" id="xs3" checked>
                                    <label class="custom-option-label" for="xs3">XS</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size4" id="s3">
                                    <label class="custom-option-label" for="s3">S</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size4" id="m3">
                                    <label class="custom-option-label" for="m3">M</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/08.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Kid's Toys</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Soft Panda Teddy Bear</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$14.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/09.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Cosmetics</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Metallic Lipstick (Crimson)</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$12.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color2" id="crimson" checked>
                                    <label class="custom-option-label rounded-circle" for="crimson"><span class="custom-option-color rounded-circle" style="background-color: #bd3c82;"></span></label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color2" id="creamy">
                                    <label class="custom-option-label rounded-circle" for="creamy"><span class="custom-option-color rounded-circle" style="background-color: #ebae81;"></span></label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color2" id="palm">
                                    <label class="custom-option-label rounded-circle" for="palm"><span class="custom-option-color rounded-circle" style="background-color: #ca8799;"></span></label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/10.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s Accessories</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">5-Pack Multicolor Bracelets</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$7.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/11.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s Sandals</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Soft Footbed Sandals</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$99.<small>50</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color1" id="blue2" checked>
                                    <label class="custom-option-label rounded-circle" for="blue2"><span class="custom-option-color rounded-circle" style="background-color: #879fb3;"></span></label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color1" id="brown">
                                    <label class="custom-option-label rounded-circle" for="brown"><span class="custom-option-color rounded-circle" style="background-color: #9c6d4a;"></span></label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color1" id="black">
                                    <label class="custom-option-label rounded-circle" for="black"><span class="custom-option-color rounded-circle" style="background-color: #333333;"></span></label>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <select class="custom-select custom-select-sm mr-2">
                                    <option>9.5</option>
                                    <option>10</option>
                                    <option>10.5</option>
                                    <option>11</option>
                                    <option>11.5</option>
                                </select>
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            </div>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/12.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s Hats</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$25.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size5" id="s4" checked>
                                    <label class="custom-option-label" for="s4">S</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size5" id="m4">
                                    <label class="custom-option-label" for="m4">M</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size5" id="l4">
                                    <label class="custom-option-label" for="l4">L</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card"><span class="badge badge-danger badge-shadow">Sale</span>
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/13.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s T-shirts</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Cotton Polo Regular Fit</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$11.<small>50</small></span>
                                    <del class="font-size-sm text-muted">$13.<small>50</small></del>
                                </div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i><i class="sr-star czi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size6" id="s5">
                                    <label class="custom-option-label" for="s5">S</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size6" id="m5">
                                    <label class="custom-option-label" for="m5">M</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size6" id="l5" checked>
                                    <label class="custom-option-label" for="l5">L</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size6" id="xl5">
                                    <label class="custom-option-label" for="xl5">XL</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/14.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s Jeans</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Slim Taper Fit Jeans</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$58.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size7" id="s6">
                                    <label class="custom-option-label" for="s6">S</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size7" id="m6">
                                    <label class="custom-option-label" for="m6">M</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size7" id="l6" checked>
                                    <label class="custom-option-label" for="l6">L</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size7" id="xl6">
                                    <label class="custom-option-label" for="xl6">XL</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <!-- Product-->
                <div class="col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/15.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s Waistcoats</a>
                            <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Single-breasted Trenchcoat</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$79.<small>99</small></span></div>
                                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <div class="text-center pb-2">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size8" id="m7">
                                    <label class="custom-option-label" for="m7">M</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size8" id="l7" checked>
                                    <label class="custom-option-label" for="l7">L</label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="size8" id="xl7">
                                    <label class="custom-option-label" for="xl7">XL</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-3">
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
