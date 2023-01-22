@extends('layouts.admin')


@section('content')
    <div class="container">
        <div class="row mt-5">

            {{-- Back to All --}}
            <div class="col-12">
                <a href="{{ url()->previous() }}" class="btn btn-dark">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            {{-- / Back to All --}}


            <div class="col-12 text-center">

                {{-- Title --}}
                <h2 class="text-primary">{{ $type->name }} </h2>
                <span> <strong>slug:</strong> {{ $type->slug }} </span>
                {{-- / Title --}}


                <div class="mt-5 text-start">

                    {{-- Subtitle --}}
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>There are others {{ count($type->projects) }} projects using
                                {{ $type->name }}</strong>
                        </div>

                        <div class="mx-4">
                            others:
                            @foreach ($types as $singleType)
                                <a href="{{ route('admin.types.show', $singleType->id) }}"
                                    class="mx-1"><em>{{ $singleType->name }}</em></a>
                            @endforeach
                        </div>
                    </div>
                    {{-- /Subtitle --}}



                    <div class="row mt-3">
                        {{-- Project Cards --}}
                        @forelse ($type->projects as $project)
                            <div class="col-3 mt-3">
                                <div class="card" style="width: 18rem;">

                                    {{-- Image --}}
                                    @if ($project->cover_img)
                                        <img class="card-img-top" src="{{ asset('storage/' . $project->cover_img) }}"
                                            alt="{{ 'cover img of ' . $project->title }}">
                                    @else
                                        <div class="py-5 text-center bg-secondary bg-opacity-25 card-img-top">
                                            No image found
                                        </div>
                                    @endif
                                    {{-- / Image --}}

                                    {{-- Text --}}
                                    <div class="card-body">
                                        {{-- Title + Description --}}
                                        <h5 class="card-title">{{ $project->title }}</h5>
                                        <p class="card-text"> {{ $project->description }} </p>
                                        {{-- / Title + Description --}}

                                        {{-- LIST --}}
                                        <ul class="list-group list-group-flush">
                                            {{-- Technology # --}}
                                            <li class="list-group-item">
                                                @foreach ($project->technologies as $tech)
                                                    <a href="{{ route('admin.technologies.show', $tech->id) }}"
                                                        class="me-2">
                                                        #{{ $tech->name }} </a>
                                                @endforeach
                                            </li>
                                            {{-- / Technology # --}}

                                            {{-- Type --}}
                                            <li class="list-group-item text-success">
                                                @if ($project->type)
                                                    {{ $project->type->name }}
                                                @else
                                                    <span>---</span>
                                                @endif
                                            </li>
                                            {{-- / Type --}}

                                            {{-- Year Creation --}}
                                            <li class="list-group-item">made in {{ $project->creation_year }}</li>
                                            {{-- /Year Creation --}}
                                        </ul>
                                        {{-- / LIST --}}

                                        {{-- Btn see details proj --}}
                                        <div class="text-end">
                                            <a href="{{ route('admin.projects.show', $project->slug) }}"
                                                class="btn btn-outline-secondary"> see details </a>
                                        </div>
                                        {{-- / Btn see details proj --}}
                                    </div>
                                    {{-- /Text --}}
                                </div>
                            </div>
                            {{-- /Project Card  --}}

                        @empty
                            {{-- Without any project --}}
                            <span class="mt-3 fs-3 text-secondary">
                                <em> No project found under the tag {{ $type->name }}</em>
                            </span>
                            {{-- /Without any project --}}
                        @endforelse

                    </div>

                </div>
            </div>


            @include('partials.to-top-btn')

        </div>
    </div>
@endsection
