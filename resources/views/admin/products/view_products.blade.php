@extends('layouts.adminLayout.admin_design')
@section('loadCss')
    <link rel="stylesheet" href="{{ asset('backend/assets/extra-libs/DataTables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/extra-libs/DataTables/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/sweetalert.min.css') }}">
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
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success" role="alert">
                        {!! session('flash_message_success') !!}
                    </div>
                @endif
                <div class="table-responsive">
                    <div id="example_wrapper"></div>
                    <table id="productsTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Sort</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>List Price</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="v-middle">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sort }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->list_price }}</td>
                                <td>
                                    @if(!empty($product->image))
                                        <img src="{{ asset('backend/images/products/small/'.$product->image) }}" width="100" alt="{{ $product->name }}">
                                    @endif
                                </td>
                                <td>{{ $product->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#productModal-{{ $product->id }}">
                                        Preview
                                    </button>
                                    <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('/admin/add-attributes/'.$product->id) }}" class="btn btn-primary">Attributes</a>
                                    <a rel="{{ $product->id }}" rel1="delete-product" href="javascript:void(0)" id="deleteRecord" class="btn btn-danger">Remove</a>

                                    <!-- ============================================================== -->
                                    <!-- Product Details Popup -->
                                    <!-- ============================================================== -->
                                    <div class="modal fade" id="productModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModal-{{ $product->id }}Label" aria-hidden="true ">
                                        <div class="modal-dialog modal-lg" role="document ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="productModal-{{ $product->id }}Label">{{ $product->name }} - {{ $product->id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true ">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img src="{{ asset('backend/images/products/small/'.$product->image) }}" width="100%" alt="{{ $product->name }}">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Code
                                                                        <span>{{ $product->code }}</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Sort
                                                                        <span>{{ $product->sort }}</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Category
                                                                        <span>{{ $product->category_name }}</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Price
                                                                        <span>{{ $product->price }}</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        List Price
                                                                        <span>{{ $product->list_price }}</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Status
                                                                        <span>
                                                                            @if($product->status == 1)
                                                                                Active
                                                                            @else
                                                                                Disabled
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Updated At
                                                                        <span>{{ date('D, d F Y - h:i:s', strtotime($product->updated_at)) }}</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        Created At
                                                                        <span>{{ date('D, d F Y - h:i:s', strtotime($product->created_at)) }}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- End Product Details Popup -->
                                    <!-- ============================================================== -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Sort</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>List Price</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
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
    <script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/js/product.js') }}"></script>
@endsection
