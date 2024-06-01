@extends('layouts.admin')

@section('content')
    <div class="container edit-form">

        <h1 class="mt-5 mb-3 _create-title fw-bolder text-warning">
            Add a new project
        </h1>

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="text-light fw-light" for="title" class="form">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp"
                    placeholder="laravel-test" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="description" class="form">Description</label>
                <textarea type="text" class="form-control" rows="4" name="description" id="description"
                    aria-describedby="DescriptionHelp" placeholder="A small description of the project">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="project_start_date" class="form">Project Start Date</label>
                <input type="text" class="form-control" name="project_start_date" id="project_start_date"
                    aria-describedby="project_start_dateHelp" placeholder="Type here the Project Start Date"
                    value="{{ old('project_start_date') }}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="project_end_date" class="form">Project End Date</label>
                <input type="text" class="form-control" name="project_end_date" id="project_end_date"
                    aria-describedby="project_end_dateHelp" placeholder="Type here the Project End Date"
                    value="{{ old('project_end_date') }}">
            </div>

            <div class="mb-3">
                <label class="form-label text-light fw-light" for="type_id">Project Type</label>
                <select class="form-select form-select" name="type_id" id="type_id">
                    <option selected>Select a type</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach

                </select>
            </div>

            <label class="form-label fw-light" for="technology">Project Type</label>
            <div class="mb-3 d-flex border rounded gap-1 py-2">

                @foreach ($technologies as $technology)
                    <div class="form-check ">

                        <input name="technologies[]" type="checkbox" class="btn" id="tag-{{ $technology->id }}"
                            value="{{ $technology->id }}" autocomplete="off"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        <label class="btn" for="tag-{{ $technology->id }}">{{ $technology->name }}</label>

                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="link_to_source_code" class="form">Link to the Source Code</label>
                <input type="text" class="form-control" name="link_to_source_code" id="link_to_source_code"
                    aria-describedby="link_to_source_codeHelp" placeholder="Type here the project Link to the Source Code"
                    value="{{ old('link_to_source_code') }}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="link_to_project_view" class="form">Link to the Project
                    View</label>
                <input type="text" class="form-control" name="link_to_project_view" id="link_to_project_view"
                    aria-describedby="link_to_project_viewHelp" placeholder="Type here the Link to the Project View"
                    value="{{ old('link_to_project_view') }}">
            </div>

            <div class="mb-3 ">
                <label for="preview_image" class="form-label text-light fw-light">Update your preview
                    image</label>
                <input type="file" class="form-control" @error('cover_image') is-invalid @enderror name="preview_image"
                    id="preview_image" placeholder="" aria-describedby="fileHelpId" value="{{ old('preview_image') }}" />
            </div>

            <div class="mx-auto d-flex justify-content-between text-end mt-3 mb-3">

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>

                <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}" role="button">
                    Go back
                </a>

            </div>

        </form>

    </div>
@endsection
