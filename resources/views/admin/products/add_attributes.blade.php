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
                    <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/add-attributes/'.$productDetails->id) }}" method="post" name="add_attributes" id="add_attributes">
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                        <div class="card-body">
                            <h4 class="card-title">Add Attribute</h4>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Product Name</strong>
                                                <span>{{ $productDetails->name }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Product Code</strong>
                                                <span>{{ $productDetails->code }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="field_wrapper">
                                    <div class="row">
                                        <div class="col form-group">
                                            <input type="text" name="sku[]" class="form-control" id="sku" placeholder="SKU">
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" name="size[]" class="form-control" id="size" placeholder="Size">
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" name="price[]" class="form-control" id="price" placeholder="Price">
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" name="stock[]" class="form-control" id="stock" placeholder="Stock">
                                        </div>
                                        <div class="col form-group">
                                            <a href="javascript:void(0);" class="add_button">Add</a>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card card-body">
                    <h3>View Attributes</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div id="example_wrapper"></div>
                    <table id="productsTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Attribute ID</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productDetails['attributes'] as $attribute)
                            <tr class="v-middle">
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->sku }}</td>
                                <td>{{ $attribute->size }}</td>
                                <td>{{ $attribute->price }}</td>
                                <td>{{ $attribute->stock }}</td>
                                <td>
                                    <a rel="{{ $attribute->id }}" rel1="delete-attribute" href="javascript:void(0)" id="deleteRecord" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Attribute ID</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
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
