@extends('layouts.admin')

@section('content')
    <div class="container edit-form">

        <h1 class="mt-5 mb-3 _create-title fw-bolder text-warning">
            Add a new project
        </h1>

        <form action="{{ route('admin.projects.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label class="text-light fw-light" for="title" class="form">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp"
                    placeholder="ex.laravel-post-office" value="{{old('title')}}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="description" class="form">Description</label>
                <textarea type="text" class="form-control" rows="4" name="description" id="description"
                    aria-describedby="DescriptionHelp"
                    placeholder="ex. The project collects the entire source code for the creation of a web app of a real post office...">{{old('description')}}</textarea>
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="project_start_date" class="form">Project Start Date</label>
                <input type="text" class="form-control" name="project_start_date" id="project_start_date"
                    aria-describedby="project_start_dateHelp" placeholder="Type here the Project Start Date" value="{{old('project_start_date')}}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="project_end_date" class="form">Project End Date</label>
                <input type="text" class="form-control" name="project_end_date" id="project_end_date"
                    aria-describedby="project_end_dateHelp" placeholder="Type here the Project End Date" value="{{old('project_end_date')}}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="link_to_source_code" class="form">Link to the Source Code</label>
                <input type="text" class="form-control" name="link_to_source_code" id="link_to_source_code"
                    aria-describedby="link_to_source_codeHelp" placeholder="Type here the project Link to the Source Code" value="{{old('link_to_source_code')}}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="link_to_project_view" class="form">Link to the Project
                    View</label>
                <input type="text" class="form-control" name="link_to_project_view" id="link_to_project_view"
                    aria-describedby="link_to_project_viewHelp" placeholder="Type here the Link to the Project View" value="{{old('link_to_project_view')}}">
            </div>

            <div class="mx-auto d-flex justify-content-between text-end mt-3">
                <button type="submit" class="btn btn-warning rounded-3 fw-light text-secondary btn-sm fs-2 px-3 py-1">Submit</button>

                <a class="btn btn-secondary rounded-3 fw-light text-light btn-sm fs-2 px-3 py-1"
                    href="{{ route('admin.projects.index') }}" role="button">
                    Go back
                </a>
            </div>

        </form>

    </div>
@endsection