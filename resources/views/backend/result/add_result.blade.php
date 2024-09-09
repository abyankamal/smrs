@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Declare A Result</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Declare</a></li>
                        <li class="breadcrumb-item active">Result</li>
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
                    <h4 class="card-title">Declare Student Result</h4>
                    <form action="{{ route('store.result') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Class</label>
                            <div class="col-sm-10">
                                <select name="class_id" class="form-select dynamic" data-dependant="student" aria-label="Default select example">
                                    <option selected="">-- Select A Class</option>
                                    @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Student</label>
                            <div class="col-sm-10">
                                <select name="student_id" class="form-select" id="student" aria-label="Default select example">
                                    <option selected="">-- Select A Student</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10" id="alert">
                            </div>
                        </div>
                        <div class="row mb-3 showSubjects">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Subjects</label>
                            <div class="col-sm-10 sub">
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
        $('.showSubjects').hide();

        $('.dynamic').on('change', function() {
            let class_id = $(this).val(); // Corrected value fetching
            let _token = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ route('fetch.student') }}",
                method: "GET",
                dataType: "json",
                data: {
                    class_id: class_id, // Corrected class_id passing
                    _token: _token
                },
                success: function(result) {
                    $('#student').html(result.students); // Populate students dropdown
                    $('.sub').html(result.subjects); // Populate subjects area
                    $('.showSubjects').show(); // Show the subjects section
                }
            });
        });

        $('#student').change(function() {
            let student_id = $(this).val()
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('check.student.result') }}",
                method: "GET",
                dataType: "json",
                data: {
                    student_id: student_id, // Corrected class_id passing
                    _token: _token
                },
                success: function(result) {
                    $('#alert').html(result.message)
                }
            });
        })
    });
</script>
@endsection