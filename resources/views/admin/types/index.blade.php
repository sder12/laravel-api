@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="my-5 text-center fw-bold text-uppercase"">Types</h3>

                {{-- MESSAGE FROM CONTROLLER --}}
                @include('partials.session-message')
                {{-- / MESSAGE FROM CONTROLLER --}}

                {{-- ERROR --}}
                @include('partials.errors')
                {{-- / ERROR --}}

            </div>

            {{-- FORM Button addons --}}
            <div class="col-4">
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Add new type" aria-label="Add new type"
                            aria-describedby="Add new type" for="new-type" name="name">
                        <button class="btn btn-success" type="submit" id="new-type" type="submit">Save</button>
                    </div>
                </form>
            </div>
            {{-- / FORM Button addons --}}

            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-start">Name</th>
                            <th scope="col">slug</th>
                            <th scope="col">Project n°</th>
                            <th scope="col">---</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                {{-- Name --}}
                                <td class="text-start">
                                    <form id="edit-type-{{ $type->id }}"
                                        action="{{ route('admin.types.update', $type->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" id="name" class="form-control border-0"
                                            value="{{ $type->name }}">
                                    </form>
                                </td>
                                {{-- /Name --}}

                                {{-- Slug --}}
                                <td class="text-center"> {{ $type->slug }} </td>
                                {{-- /Slug --}}

                                {{-- Count --}}
                                <td class="text-center">
                                    <em> {{ count($type->projects) }}</em>
                                </td>
                                {{-- /Count --}}

                                {{-- Show --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.types.show', $type->id) }}" class="btn btn-secondary">
                                        see all</a>
                                </td>
                                {{-- /Show --}}

                                {{-- Edit + Delete --}}
                                <td class="d-flex justify-content-center">
                                    {{-- edit --}}
                                    <button form="edit-type-{{ $type->id }}" class="btn btn-warning mx-2"
                                        type="submit">
                                        save
                                    </button>
                                    {{-- delete --}}
                                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">x</button>
                                    </form>
                                </td>
                                {{-- / Edit + Delete --}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
