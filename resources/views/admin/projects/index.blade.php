@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">

            {{-- PAGINATOR --}}
            <div class="my-3 col-8">
                {{ $projects->links() }}
            </div>
            {{-- /PAGINATOR --}}

            <h3 class="text-center fw-bold text-uppercase">Projects</h3>


            <div class="col-10">

                {{-- MESSAGE FROM CONTROLLER --}}
                @include('partials.session-message')
                {{-- / MESSAGE FROM CONTROLLER --}}

                {{-- Add new proj --}}
                <div class="text-end">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-dark text-end">
                        <i class="fa-regular fa-square-plus"></i>
                    </a>
                </div>
                {{-- / Add new proj --}}


                {{-- TABLE --}}
                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">Year</th>
                            <th scope="col">Image</th>
                            <th scope="col">Type</th>
                            <th scope="col">Technology</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <th scope="row" class="fw-semibold">{{ $project->title }}</th>
                                <td class="px-3">{{ $project->creation_year }}</td>

                                {{-- Images --}}
                                <td>
                                    <div class="text-center">
                                        @if ($project->cover_img)
                                            <img src="{{ asset('storage/' . $project->cover_img) }}" alt=""
                                                id="img-proj-index">
                                        @else
                                            <div class="py-4 text-center bg-warning bg-opacity-25"> No image yet </div>
                                        @endif
                                    </div>
                                </td>
                                {{-- /Images --}}

                                <td class="text-center">{{ $project->type ? $project->type->name : '---' }}</td>
                                <td>
                                    <ul class="list-group list-group-flush">
                                        @forelse ($project->technologies as $tech)
                                            <li class="list-group-item"><em> {{ $tech->name }} </em></li>
                                        @empty
                                            <li class="list-group-item text-center"> --- </li>
                                        @endforelse
                                    </ul>
                                </td>
                                {{-- ACTIONS --}}
                                <td>
                                    {{-- Show --}}
                                    <div class="d-flex">
                                        <a class="btn btn-success"
                                            href="{{ route('admin.projects.show', $project->slug) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        {{-- Edit --}}
                                        <a class="btn btn-warning mx-1"
                                            href="{{ route('admin.projects.edit', $project->slug) }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        {{-- Delete using app.js and partials.modal --}}
                                        <form class="d-inline-block"
                                            action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger delete-btn"
                                                data-project-title="{{ $project->title }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                {{-- /ACTIONS --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- /TABLE --}}

                @include('partials.to-top-btn')

            </div>
        </div>
    </div>
    {{-- Delete Modal --}}
    @include('partials.delete-modal')
    {{-- / Delete Modal --}}
@endsection
