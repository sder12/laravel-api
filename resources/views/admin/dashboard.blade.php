@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header"> Dashboard</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4>Welcome {{ Auth::user()->name }}</h4>
                        <span>You are logged in!</span>

                        <div class="mt-2">
                            <a href="{{ route('admin.projects.index') }}">click here to see all your project</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
