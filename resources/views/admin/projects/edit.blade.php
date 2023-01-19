@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        {{-- Back to All --}}
        <div>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-dark">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        {{-- / Back to All --}}

        <div class="row justify-content-center">
            <div class="col col-8">

                {{-- HEADING --}}
                <div class="mb-3 pb-2 border-bottom border-warning  border-2">
                    <span class="d-block mb-2"> MODIFY: </span>
                    <h4> {{ $project->title }}</h4>
                </div>
                {{-- / HEADING --}}

                @include('partials.errors')

                {{-- FORM PROJECT --}}
                <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title project --}}
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control  @error('title') is-invalid @enderror" id="title" type="text"
                            name="title" value="{{ $project->title }}">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- / Title project --}}

                    {{-- IMAGE --}}
                    <div class="mb-3">
                        <label class="form-label" for="cover_img">Image</label>
                        <input class="form-control @error('cover_img') is-invalid @enderror" id="cover_img" type="file"
                            name="cover_img" value="{{ $project->cover_img }}">

                        @error('cover_img')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        {{-- Preview img --}}
                        <div style="max-height: 200px">
                            <img id="image_preview" src="{{ asset('storage/' . $project->cover_img) }}" class="w-25"
                                alt="{{ $project->title . "'s cover img" }}">
                        </div>
                    </div>
                    {{-- / IMAGE --}}

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3">{{ $project->description }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- / Description --}}

                    {{-- Year --}}
                    <div class="mb-3 col-4">
                        <label class="form-label" for="creation_year">Year of creation</label>
                        <input class="form-control  @error('creation_year') is-invalid @enderror" id="creation_year"
                            type="number" min="1990" max="2030" value="{{ $project->creation_year }}"
                            name="creation_year">

                        @error('creation_year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- / Year --}}

                    {{-- Types --}}
                    <div class="mb-3 col-4">
                        <label for="type">Type:</label>
                        <select name="type_id" id="type" class="form-select mt-2">
                            <option value=""> - </option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected($project->type?->id == $type->id)>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- /Types --}}

                    {{-- Technologies --}}
                    <div class="form-group mb-3">
                        <span>Technologies:</span>
                        @foreach ($technologies as $tech)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="technology-{{ $tech->id }}"
                                    name="technologies[]" value="{{ $tech->id }}" @checked($errors->any() ? in_array($tech->id, old('technologies', [])) : $project->technologies->contains($tech))>
                                <label class="form-check-label" for="technology-{{ $tech->id }}">
                                    {{ $tech->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    {{-- /Technologies --}}


                    {{-- Btn SAVE --}}
                    <div class="mb-3 pt-2">
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                    {{-- /Btn SAVE --}}

                </form>
                {{-- /FORM PROJECT --}}
            </div>
        </div>
    </div>
@endsection
