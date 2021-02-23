@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task Manager</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todo-list.create') }}"> Create New Task</a>
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
            <th>ID</th>
        </tr>
        @foreach ($lists as $todo_list)
            <tr>
                <td>{{ $todo_list->id }}</td>
            </tr>
        @endforeach
    </table>


@endsection
