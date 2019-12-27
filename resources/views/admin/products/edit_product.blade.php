@extends('layouts.adminLayout.admin_design')
@section('loadCss')
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/toastr/build/toastr.min.css') }}">
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
                    <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/edit-product/'.$productDetails->id) }}" method="post" name="edit_category" id="edit_category">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <h4 class="card-title">Edit <span class="text-primary">{{ $productDetails->name }}</span></h4>

                            <ul class="nav nav-pills flex-column flex-sm-row shadow-sm mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item flex-sm-fill text-sm-center">
                                    <a class="nav-link active" id="pills-content-tab" data-toggle="pill" href="#pills-content" role="tab" aria-controls="pills-content" aria-selected="true">Content</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center">
                                    <a class="nav-link" id="pills-picture-tab" data-toggle="pill" href="#pills-picture" role="tab" aria-controls="pills-picture" aria-selected="false">Picture</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center">
                                    <a class="nav-link" id="pills-sale-tab" data-toggle="pill" href="#pills-sale" role="tab" aria-controls="pills-sale" aria-selected="false">Sale</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-content" role="tabpanel" aria-labelledby="pills-content-tab">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="status" class="custom-control-input" id="status" @if($productDetails->status == 1) checked @endif value="1">
                                                <label class="custom-control-label" for="status"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sort" class="col-sm-3 text-right control-label col-form-label">Sort</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="0" name="sort" class="form-control" value="{{ $productDetails->sort }}" id="sort" placeholder="Sort">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Under Category</label>
                                        <div class="col-sm-9">
                                            <select name="category_id" class="form-control" id="category_id">
                                                <?= $categoriesDropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ $productDetails->name }}" class="form-control" id="name" placeholder="Product Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="code" class="col-sm-3 text-right control-label col-form-label">Product Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="code" value="{{ $productDetails->code }}" class="form-control" id="code" placeholder="Product Code">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-right control-label col-form-label">Product Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" class="form-control" id="description" placeholder="Product Description">{{ $productDetails->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="care" class="col-sm-3 text-right control-label col-form-label">Materials and Care</label>
                                        <div class="col-sm-9">
                                            <textarea name="care" class="form-control" id="care" placeholder="Materials and Care">{{ $productDetails->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-picture" role="tabpanel" aria-labelledby="pills-picture-tab">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Product Picture</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="hidden" name="current_image" value="{{ $productDetails->image }}">
                                                <input type="file" class="custom-file-input" name="image" id="image">
                                                <label class="custom-file-label" for="image">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        @if(!empty($productDetails->image))
                                            <div class="img-wrap">
                                                <span class="close" id="ajaxRemoveImage" data-image-id="{{ $productDetails->id }}">&times;</span>
                                                <img src="{{ asset('/backend/images/products/medium/'.$productDetails->image) }}" width="300" alt="{{ $productDetails->name }}">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row mt-5 mb-3">
                                        <label class="col-sm-3 text-right control-label col-form-label">More Photos</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="more_photo[]" id="more_photo" multiple>
                                                <label class="custom-file-label" for="more_photo">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row px-2">
                                        <div class="col-md-12">
                                            <h4>More Photos</h4>
                                        </div>

                                        @foreach($morePhotos as $morePhoto)
                                            <div class="col-md-2">
                                                <div class="img-wrap">
                                                    <span class="close" id="ajaxRemoveMorePhoto" data-image-id="{{ $morePhoto->id }}">&times;</span>
                                                    <img src="{{ asset('/backend/images/products/medium/'.$morePhoto->more_photo) }}" width="100%" alt="{{ $morePhoto->id }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-sale" role="tabpanel" aria-labelledby="pills-sale-tab">
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-3 text-right control-label col-form-label">Product Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="price" value="{{ $productDetails->price }}" class="form-control" id="price" placeholder="Product Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for=list-"price" class="col-sm-3 text-right control-label col-form-label">Product List Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="list_price" value="{{ $productDetails->list_price }}" class="form-control" id="list-price" placeholder="Product List Price">
                                        </div>
                                    </div>
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
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/js/product.js') }}"></script>
@endsection
