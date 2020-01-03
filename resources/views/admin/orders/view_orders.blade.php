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
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Ordered Products</th>
                                <th>Order Amount</th>
                                <th>Order Status</th>
                                <th>Payment Method</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="v-middle">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->user_email }}</td>
                                    <td>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb m-0 p-0 bg-transparent">
                                                @foreach($order->orders as $orderedProducts)
                                                    <li class="breadcrumb-item">{{ $orderedProducts->product_code }} ({{ $orderedProducts->product_qty }})</li>
                                                @endforeach
                                            </ol>
                                        </nav>
                                    </td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>
                                        <a href="{{ url('/admin/view-orders/'.$order->id) }}" class="btn btn-primary">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Ordered Products</th>
                                <th>Order Amount</th>
                                <th>Order Status</th>
                                <th>Payment Method</th>
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
