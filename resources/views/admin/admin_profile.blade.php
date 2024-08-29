@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Admin Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Admin Profile Update</h4>
                    <form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="name" type="text" value="{{ $userdata->name }}" placeholder="Username" id="example-text-input">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" name="email" value="{{ $userdata->email }}" placeholder="Email@example.com" id="example-search-input">
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password" placeholder="Input Password" id="example-email-input">
                            </div>
                        </div> -->
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
                                <img id="changeImage" src="{{ empty($userdata->photo) ? asset('uploads/no_image.png') : asset('uploads/admin_profile/'.$userdata->photo) }}" class="rounded avatar-md"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info w-25 waves-effect waves-light" type="submit">Save</button>
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