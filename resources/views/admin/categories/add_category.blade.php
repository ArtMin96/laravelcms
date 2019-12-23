@extends('layouts.adminLayout.admin_design')
@section('content')

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-6">
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
                    <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/add-category') }}" method="post" name="add_category" id="add_category">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <h4 class="card-title">Add Category</h4>

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" value="1">
                                        <label class="custom-control-label" for="status"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Category Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Category Level</label>
                                <div class="col-sm-9">
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="0">Main Category</option>
                                        @foreach($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-right control-label col-form-label">URL Code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="url" class="form-control" id="url" placeholder="URL Code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sort" class="col-sm-3 text-right control-label col-form-label">Sort</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" name="sort" class="form-control" value="500" id="sort" placeholder="Sort">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 text-right control-label col-form-label">Category Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="description" placeholder="Category Description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Category Picture</label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">Choose file...</label>
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
    <script src="{{ asset('backend/js/category.js') }}"></script>
@endsection
