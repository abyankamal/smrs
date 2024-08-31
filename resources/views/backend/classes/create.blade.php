@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Student Classes</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Classes</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Student Class</h4>
                    <form action="{{ route('store.class') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Class Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="class_name" placeholder="Input Class Name" id="old-password-input">
                                <p class="font-style: italic">Eg: First, Second, Third, etc</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Class Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="section" placeholder="Input Secton" id="old-password-input">
                                <p class="font-style: italic">Eg: First, Second, Third, etc</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info w-25 waves-effect waves-light">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
</div>
@endsection