@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Beer</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('todo-task.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('todo-task.update', $task->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" value="{{ $task->title }}" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="exampleFormControlSelect1">Is Done:</label>
                <select class="form-control" name="is_done" id="exampleFormControlSelect1">
                    <option value="1">Not Done</option>
                    <option value="2" selected>In Progress</option>
                    <option value="3">Need Review</option>
                    <option value="4">Done</option>
                </select>
            </div>
            <input type="hidden" name="todo_list_id" value="{{ $task->todo_list_id }}">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
@section('toHome')
@endsection
