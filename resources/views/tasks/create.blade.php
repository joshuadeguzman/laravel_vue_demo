@extends('layouts.app')

@section('page-title')
    | Create Task
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Create New Task</li>
                </div>
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <task-create :user-id="{{ $uid }}"></task-create>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
