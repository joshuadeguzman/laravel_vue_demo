@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Task</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>Task Details</h5>
                        <task-edit :task-id="{{ $task->id }}"></task-edit>
                        <h5>Task Tags</h5>
                        <tags :task-id="{{ $task->id }}"></tags>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
