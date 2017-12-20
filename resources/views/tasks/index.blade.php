@extends('layouts.app')
@section('content')
<!-- Create Task Form... -->
<!-- Current Tasks -->
  <div class="panel panel-default">
     <div class="panel-heading">
        Current Tasks <a href="{{ url('tasks/create') }}" class="btn btn-warning">Add</a>
     </div>
     <div class="panel-body">
        <table class="table table-striped task-table">
          <!-- Table Headings -->
          <thead>
            <th>Task</th>
            <th>&nbsp;</th>
          </thead>
          <!-- Table Body -->
          <tbody>
            @foreach ($tasks as $task)
            <tr>
              <!-- Task Name -->
              <td class="table-text">
                <div>{{ $task->name }}</div>
              </td>
              <td class="table-text">
                <div>{{ $task->user->username }}</div>
              </td>
              <!-- Delete Button -->
              <td>
                <form action="{{ url('task/'.$task->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="hidden" name="_method" value="DELETE">
                <a href="{{ url('tasks/edit/'.$task->id) }}" class="btn btn-warning">Edit</a>
                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                <i class="fa fa-btn fa-trash"></i>Delete
                </button>
                </form>
              </td>
              </tr>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if ($message = Session::get('success_create'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
      @if ($message = Session::get('success_update'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
@endsection
