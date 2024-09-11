@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Result</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit</a></li>
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
                    <h4 class="card-title">Update Student Result</h4>
                    <form action="{{ route('update.result') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Student Name</label>
                            <div class="col-sm-10">
                                <h6 style="padding-top: 10px; font-style: italic">{{ $result[0]->student->name }}</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Class</label>
                            <div class="col-sm-10">
                                <h6 style="padding-top: 10px; font-style: italic">{{ $result[0]->student->class->class_name }} - {{ $result[0]->student->class->section }}</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10" id="alert">
                            </div>
                        </div>
                        @php
                        $count = count($result);
                        @endphp
                        <div class="row mb-3 showSubjects">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Subjects</label>
                            <div class="col-sm-10 sub">
                                @for ($i = 0; $i < $count; $i++)
                                    <label for="{{$result[0]->subject->subject_name}}">{{$result[$i]->subject->subject_name}}</label>
                                    <input type="hidden" class="form-control" name="result_id[]" value="{{$result[$i]->id}}" type="hidden">
                                    <input type="hidden" class="form-control" name="subject_id[]" value="{{$result[$i]->subject->id}}" type="hidden">
                                    <input type="hidden" class="form-control" name="student_id[]" value="{{$result[$i]->student->id}}" type="hidden">
                                    <input type="text" class="form-control" name="marks[]" required type="text" placeholder="Enter mark out of 100" value="{{$result[$i]->marks}}">
                                    @endfor
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