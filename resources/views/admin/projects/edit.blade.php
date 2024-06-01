@extends('layouts.admin')

@section('content')
    <div class="container w-75 pb-5 edit-form">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-5 mb-3 text-primary">
            <span>Make adjustments to your</span>
            <span class="text-info">{{ $project->title }}</span>
            <span>project</span>
        </div>

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.partials.validation-errors')

            <div class="mb-3">
                <label class="text-light fw-light" for="title" class="form">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp"
                    placeholder="ex.laravel-post-office" value="{{ old('title', $project->title) }}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="description" class="form">Description</label>
                <textarea type="text" class="form-control" rows="4" name="description" id="description"
                    aria-describedby="DescriptionHelp"
                    placeholder="ex. The project collects the entire source code for the creation of a web app of a real post office...">{{ old('description', $project->description) }}
                </textarea>
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="project_start_date" class="form">Project Start
                    Date</label>
                <input type="text" class="form-control" name="project_start_date" id="project_start_date"
                    aria-describedby="project_start_dateHelp" placeholder="Type here the Project Start Date"
                    value="{{ old('project_start_date', $project->project_start_date) }}">
            </div>

            <div class="mb-3">
                <label class="text-light fw-light" for="project_end_date" class="form">Project End Date</label>
                <input type="text" class="form-control" name="project_end_date" id="project_end_date"
                    aria-describedby="project_end_dateHelp" placeholder="Type here the Project End Date"
                    value="{{ old('project_end_date', $project->project_end_date) }}">
            </div>

            <label class="form-label fw-light" for="technology">Project Type</label>
            <div class="mb-3 d-flex border rounded gap-1 py-2">

                @foreach ($technologies as $technology)
                    @if ($errors->any())
                        <div class="form-check ">
                            <h4 class="text-danger">error</h4>


                            <div class="form-check">

                                <input name="technologies[]" type="checkbox" class="btn-check"
                                    id="tag-{{ $technology->id }}" value="{{ $technology->id }}" autocomplete="off"
                                    {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                <label class="btn text-light"
                                    for="tag-{{ $technology->id }}">{{ $technology->name }}</label>

                            </div>
                        @else
                            <div class="form-check">

                                <input name="technologies[]" type="checkbox" class="btn" id="tag-{{ $technology->id }}"
                                    value="{{ $technology->id }}" autocomplete="off"
                                    {{ in_array($technology->id, $project->technologies->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label class="btn" for="tag-{{ $technology->id }}">{{ $technology->name }}
                                </label>

                            </div>
                    @endif
                @endforeach
            </div>

            <div class="image_box d-flex justify-content-between mb-4">

                <div class="left-side w-75">

                    <div class="mb-3">
                        <label class="text-light fw-light" for="link_to_source_code" class="form">Link to the
                            Source
                            Code</label>
                        <input type="text" class="form-control" name="link_to_source_code" id="link_to_source_code"
                            aria-describedby="link_to_source_codeHelp"
                            placeholder="Type here the project Link to the Source Code"
                            value="{{ old('link_to_source_code', $project->link_to_source_code) }}">
                    </div>

                    <div class="mb-3">
                        <label class="text-light fw-light" for="link_to_project_view" class="form">Link to the
                            Project
                            View</label>
                        <input type="text" class="form-control" name="link_to_project_view" id="link_to_project_view"
                            aria-describedby="link_to_project_viewHelp" placeholder="Type here the Link to the Project View"
                            value="{{ old('link_to_project_view', $project->link_to_project_view) }}">
                    </div>

                    <div class="mb-3 ">
                        <label for="preview_image" class="form-label text-light fw-light">Update your preview
                            image</label>
                        <input type="file" class="form-control" @error('cover_image') is-invalid @enderror
                            name="preview_image" id="preview_image" placeholder="" aria-describedby="fileHelpId"
                            value="{{ old('preview_image', $project->preview_image) }}" />
                    </div>
                </div>

                <div class="img d-flex w-25 flex-column align-items-end">
                    <img class="img-fluid" src="{{ asset('storage/' . $project->preview_image) }}" alt="">
                    @if ($project->preview_image)
                        <small class="text-light fs-6">Current project preview image</small>
                    @else
                        <small class="text-light fs-6">No current image to show</small>
                    @endif
                </div>

            </div>

            <div class="mx-auto d-flex justify-content-between text-end mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>

                <a class="btn btn-secondary" href="{{ url()->previous() }}" role="button">
                    Go back
                </a>
            </div>

        </form>

    </div>
@endsection
