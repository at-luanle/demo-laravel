@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Add Task</div>
          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ url('/tasks/store')}}">
              {{ csrf_field() }}
              <div class="form-group">
                  <label class="col-md-4 control-label">Full Name</label>

                  <div class="col-md-6">
                      <input type="text" class="form-control" name="taskName" value="{!! old('taskName') !!}" required autofocus>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-4 control-label">User</label>
                  <div class="col-md-6">

                    <select class="" name="taskUser">
                        <option value="{{ $user->id }}">{{$user->username}}</option>
                    </select>

                  </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-6">
                  <button type="submit" name="button" class="btn btn-default">Save</button>
                <div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
</div>
@endsection
