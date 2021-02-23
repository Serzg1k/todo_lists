@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task Manager</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todo-task.create') }}"> Create New Task</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Is Done</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($tasks as $todo_task)
            <tr>
                <td>{{ $todo_task->title }}</td>
                <td>{{ $todo_task->is_done }}</td>
                <td>
                    <form action="{{ route('todo-task.destroy',$todo_task->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('todo-task.edit',$todo_task->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
