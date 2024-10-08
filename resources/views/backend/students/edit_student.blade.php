@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Student</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit</a></li>
                        <li class="breadcrumb-item active">Student</li>
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
                    <h4 class="card-title">Edit Student Info</h4>
                    <form action="{{ route('update.student') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $student->name }}" placeholder="Input Full Name" id="old-password-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Roll ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{ $student->roll_id }}" name="roll_id" placeholder="Input Roll ID" id="old-password-input">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{ $student->email }}" name="email" placeholder="Input Email" id="old-password-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select</label>
                            <div class="col-sm-10">
                                <select name="class_id" class="form-select" aria-label="Default select example">
                                    <option selected="">-- Select Class</option>
                                    @foreach ($classes as $class)
                                    <option {{$student->class_id == $class->id ? 'selected' : ''}} value="{{$class->id}}">{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-check-input" type="radio" name="gender" value="Male" {{$student->gender== 'Male' ? 'selected' : ''}}>
                                <label for="form-check-label" for="formRadios1">Male</label>
                                <input class="form-check-input" type="radio" name="gender" value="Female" {{$student->gender== 'Female' ? 'selected' : ''}}>
                                <label for="form-check-label" for="formRadios1">Female</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="old-password-input" class="col-sm-2 col-form-label">DOB</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" value="{{$student->dob}}" name="dob" placeholder="Input Email" id="old-password-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="file" name="photo" class="form-control" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-10">
                                <img id="changeImage" src="{{ empty($student->photo) ? asset('uploads/no_image.png') : asset('uploads/student_profile/'.$student->photo) }}" class="rounded avatar-md"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
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

<script>
    $(document).ready(function() {
        $("#image").change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#changeImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    });
</script>
@endsection