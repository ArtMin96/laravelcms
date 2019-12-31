@extends('layouts.adminLayout.admin_design')
@section('loadCss')
    <link rel="stylesheet" href="{{ asset('backend/assets/extra-libs/DataTables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/extra-libs/DataTables/buttons.bootstrap4.min.css') }}">
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
                    <table id="categoryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Level</th>
                                <th>Name</th>
                                <th>Sort</th>
                                <th>Url</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr class="v-middle">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->parent_id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->sort }}</td>
                                    <td>{{ $category->url }}</td>
                                    <td>
                                        @if(!empty($category->image))
                                            <img src="{{ asset('backend/images/categories/small/'.$category->image) }}" width="100" alt="{{ $category->name }}">
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->status == 1)
                                            <span class="text-success">Active</span>
                                            @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ date('D, d F Y - h:i:s', strtotime($category->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Edit">Edit</a>
                                        <a href="{{ url('/admin/delete-category/'.$category->id) }}" id="deleteCategory" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="mdi mdi-close"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Level</th>
                                <th>Name</th>
                                <th>Sort</th>
                                <th>Url</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created</th>
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
    <script src="{{ asset('backend/js/category.js') }}"></script>
@endsection
