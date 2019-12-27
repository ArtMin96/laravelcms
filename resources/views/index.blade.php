@extends('layouts.frontLayout.front_design')
@section ('content')
    <!-- Page Content-->
    <!-- Hero slider-->
    <section class="cz-carousel cz-controls-lg">
        <div class="cz-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: false},&quot;992&quot;:{&quot;nav&quot;:false, &quot;controls&quot;: true}}}">
            <!-- Item-->
            <div class="px-lg-5" style="background-color: #3aafd2;">
                <div class="d-lg-flex justify-content-between align-items-center pl-lg-4"><img class="d-block order-lg-2 mr-lg-n5 flex-shrink-0" src="img/home/hero-slider/01.jpg" alt="Summer Collection">
                    <div class="position-relative mx-auto mr-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-left text-lg-nowrap">
                            <h2 class="text-light font-weight-light pb-1 from-left">Has just arrived!</h2>
                            <h1 class="text-light display-4 from-left delay-1">Huge Summer Collection</h1>
                            <p class="font-size-lg text-light pb-3 from-left delay-2">Swimwear, Tops, Shorts, Sunglasses &amp; much more...</p><a class="btn btn-primary scale-up delay-4" href="shop-grid-ls.html">Shop Now<i class="czi-arrow-right ml-2 mr-n1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item-->
            <div class="px-lg-5" style="background-color: #f5b1b0;">
                <div class="d-lg-flex justify-content-between align-items-center pl-lg-4"><img class="d-block order-lg-2 mr-lg-n5 flex-shrink-0" src="img/home/hero-slider/02.jpg" alt="Women Sportswear">
                    <div class="position-relative mx-auto mr-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-left text-lg-nowrap">
                            <h2 class="text-light font-weight-light pb-1 from-bottom">Hurry up! Limited time offer.</h2>
                            <h1 class="text-light display-4 from-bottom delay-1">Women Sportswear Sale</h1>
                            <p class="font-size-lg text-light pb-3 from-bottom delay-2">Sneakers, Keds, Sweatshirts, Hoodies &amp; much more...</p><a class="btn btn-primary scale-up delay-4" href="shop-grid-ls.html">Shop Now<i class="czi-arrow-right ml-2 mr-n1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item-->
            <div class="px-lg-5" style="background-color: #eba170;">
                <div class="d-lg-flex justify-content-between align-items-center pl-lg-4"><img class="d-block order-lg-2 mr-lg-n5 flex-shrink-0" src="img/home/hero-slider/03.jpg" alt="Men Accessories">
                    <div class="position-relative mx-auto mr-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-left text-lg-nowrap">
                            <h2 class="text-light font-weight-light pb-1 from-top">Complete your look with</h2>
                            <h1 class="text-light display-4 from-top delay-1">New Men's Accessories</h1>
                            <p class="font-size-lg text-light pb-3 from-top delay-2">Hats &amp; Caps, Sunglasses, Bags &amp; much more...</p><a class="btn btn-primary scale-up delay-4" href="shop-grid-ls.html">Shop Now<i class="czi-arrow-right ml-2 mr-n1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular categories-->
    <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
        <div class="row">
            <div class="col-xl-8 col-lg-9">
                <div class="card border-0 box-shadow-lg">
                    <div class="card-body px-3 pt-grid-gutter pb-0">
                        <div class="row no-gutters pl-1">
                            <div class="col-sm-4 px-2 mb-grid-gutter"><a class="d-block text-center text-decoration-none mr-1" href="shop-grid-ls.html"><img class="d-block rounded mb-3" src="img/home/categories/cat-sm01.jpg" alt="Men">
                                    <h3 class="font-size-base pt-1 mb-0">Men</h3></a></div>
                            <div class="col-sm-4 px-2 mb-grid-gutter"><a class="d-block text-center text-decoration-none mr-1" href="shop-grid-ls.html"><img class="d-block rounded mb-3" src="img/home/categories/cat-sm02.jpg" alt="Women">
                                    <h3 class="font-size-base pt-1 mb-0">Women</h3></a></div>
                            <div class="col-sm-4 px-2 mb-grid-gutter"><a class="d-block text-center text-decoration-none mr-1" href="shop-grid-ls.html"><img class="d-block rounded mb-3" src="img/home/categories/cat-sm03.jpg" alt="Kids">
                                    <h3 class="font-size-base pt-1 mb-0">Kids</h3></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Products grid (Trending products)-->
    <section class="container pt-md-3 pb-5 mb-md-3">
        <h2 class="h3 text-center">Trending products</h2>
        <div class="row pt-4 mx-n2">
            <!-- Product-->
            @if(!$productsAll->isEmpty())
                @foreach($productsAll as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                        <div class="card product-card">
                            <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
                                <i class="czi-heart"></i>
                            </button>
                            <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{ asset('backend/images/products/small/'.$product->image) }}" alt="Product"></a>
                            <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Sneakers &amp; Keds</a>
                                <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">{{ $product->name }}</a></h3>
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
        <div class="text-center pt-3"><a class="btn btn-outline-accent" href="shop-grid-ls.html">More products<i class="czi-arrow-right ml-1"></i></a></div>
    </section>
    <!-- Blog + Instagram info cards-->
    <section class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-primary" href="blog-list-sidebar.html">
                    <div class="card-body text-center"><i class="czi-edit h3 mt-2 mb-4 text-primary"></i>
                        <h3 class="h5 mb-1">Read the blog</h3>
                        <p class="text-muted font-size-sm">Latest store, fashion news and trends</p>
                    </div></a></div>
            <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-accent" href="#">
                    <div class="card-body text-center"><i class="czi-instagram h3 mt-2 mb-4 text-accent"></i>
                        <h3 class="h5 mb-1">Follow on Instagram</h3>
                        <p class="text-muted font-size-sm">#ShopWithCartzilla</p>
                    </div></a></div>
        </div>
    </section>
@endsection
