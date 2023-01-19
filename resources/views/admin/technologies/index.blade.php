{{-- TECHNOLOGIES INDEX --}}
@extends('layouts.admin')


@section('content')
    <div class="container">
        <div class="row">

            <h3 class="my-5 text-center fw-bold text-uppercase"">Technologies</h3>

            {{-- MESSAGE FROM CONTROLLER --}}
            @include('partials.session-message')
            {{-- / MESSAGE FROM CONTROLLER --}}

            {{-- ERROR --}}
            @include('partials.errors')
            {{-- / ERROR --}}

            {{-- FORM Button addons --}}
            <div class="col-4 px-5">
                <form action="{{ route('admin.technologies.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Add new technology" name="name"
                            aria-label="Add new technology" aria-describedby="create-technology-btn">
                        <button class="input-group-text btn btn-success" id="create-technology-btn"
                            type="submit">save</button>
                    </div>
                </form>
            </div>
            {{-- / FORM  --}}

            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-start">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Project n°</th>
                            <th scope='col'></th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $tech)
                            <tr>
                                {{-- <td>{{ $tech->name }}</td> --}}
                                {{-- EDIT link to btn in actions, linked tro id-form form-btn --}}
                                <td class="text-start">
                                    <form id="edit-technology-{{ $tech->id }}"
                                        action="{{ route('admin.technologies.update', $tech->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" id="name" class="form-control border-0"
                                            value="{{ $tech->name }}">
                                    </form>
                                </td>
                                <td class="text-center"><em>{{ $tech->slug }}</em></td>

                                {{-- Count --}}
                                <td class="text-center">
                                    <span class="me-2">{{ count($tech->projects) }}</span>
                                </td>
                                {{-- /Count --}}

                                {{-- Show --}}
                                <td class="text-center">
                                    {{-- show --}}
                                    <a href="{{ route('admin.technologies.show', $tech->id) }}" class="btn btn-secondary">
                                        see projects
                                    </a>
                                </td>
                                {{-- / Show --}}

                                {{-- Edit + Delete --}}
                                <td class="d-flex justify-content-center">
                                    {{-- edit --}}
                                    <button form="edit-technology-{{ $tech->id }}" class="btn btn-warning mx-2"
                                        href="" type="submit">
                                        save
                                    </button>
                                    {{-- delete --}}
                                    <form action="{{ route('admin.technologies.destroy', $tech->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger"> x </button>
                                    </form>
                                </td>
                                {{-- /Edit + Delete --}}


                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
