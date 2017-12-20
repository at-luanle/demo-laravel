<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Task;
use App\User;

class TaskController extends Controller
{
  /**
  * The task repository instance.
  *
  * @var TaskRepository
  */
  protected $tasks;

  /**
  * Create a new controller instance.
  *
  * @param  TaskRepository  $tasks
  * @return void
  */
  public function __construct(TaskRepository $tasks)
  {
    $this->middleware('auth');
    $this->tasks = $tasks;
  }

  /**
  * Display a list of all of the user's task.
  *
  * @param  Request  $request
  * @return Response
  */
  public function index()
  {
    if (Auth::check()) {
      $tasks = Task::where('user_id', Auth::id())->get();
      return view('tasks.index', compact('tasks'));
    }
  }
  public function create()
  {
    if (Auth::check()) {
      $user = User::Where('id', Auth::id())->first();
      return view('tasks.add', compact('user'));
    }
  }
  public function store(Request $request)
  {
    $this->validate($request, [
    'taskName' => 'required',
    ]);
    if (Auth::check()) {
      $task = new Task();
      $task->name = $request->taskName;
      $task->user_id = Auth::id();
      $task->save();
      return redirect('/tasks')->with('success_create', 'create Successfully');
    }
  }

  public function edit(Task $task)
  {
    return view('tasks.edit', compact('task'));
  }

  public function update(Request $request,$id)
  {
    if (Auth::check()) {
      $task = Task::findOrFail($id);
      $task->name = $request->taskName;
      $task->user_id = Auth::id();
      $task->update();
      return redirect('/tasks')->with('success_update','update Successfully');
    }
  }
  /**
 * Destroy the given task.
 *
 * @param  Request  $request
 * @param  Task  $task
 * @return Response
 */
  public function destroy($id)
  {
    if(Auth::check()) {
      $task = Task::findOrFail($id);
      $task->delete();
      return redirect('/tasks')->with('success','Delete Successfully');
    }
  }
}
