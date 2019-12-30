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
                    <table id="categoryTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Coupon Code</th>
                            <th>Amount</th>
                            <th>Amount Type</th>
                            <th>Status</th>
                            <th>Expiry Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $coupon)
                            <tr class="v-middle">
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->coupon_code }}</td>
                                <td>
                                    {{ $coupon->amount }}
                                    @if($coupon->amount_type == 'Percentage') % @else $ @endif
                                </td>
                                <td>{{ $coupon->amount_type }}</td>
                                <td>
                                    @if($coupon->status == 1) Active @else Inactive @endif
                                </td>
                                <td>{{ $coupon->expiry_date }}</td>
                                <td>
                                    <a href="{{ url('/admin/edit-coupon/'.$coupon->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="javascript:void(0)" rel="{{ $coupon->id }}" rel1="delete-coupon" id="deleteRecord" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Coupon Code</th>
                            <th>Amount</th>
                            <th>Amount Type</th>
                            <th>Status</th>
                            <th>Expiry Date</th>
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
    <script src="{{ asset('backend/js/category.js') }}"></script>
    <script>
        $(document).on('click', '#deleteRecord', function (e) {
            var id = $(this).attr('rel');
            var deleteFunction = $(this).attr('rel1');
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this record again!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'Yes, delete it!'
                },
                function () {
                    window.location.href = '/admin/'+deleteFunction+'/'+id;
                });
        });
    </script>
@endsection
