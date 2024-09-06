@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Update Subjects</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Subject</a></li>
                        <li class="breadcrumb-item active">Update</li>
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
                    <h4 class="card-title">Update Subject</h4>
                    <form action="{{ route('update.subject') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="{{$subject->id}}">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Class Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="subject_name" value="{{$subject->subject_name}}" placeholder="Input Class Name" id="old-password-input">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Subject Code</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="subject_code" value="{{$subject->subject_code}}" placeholder="Input Secton" id="old-password-input">
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