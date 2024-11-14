<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use DB;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Error;

class TaskController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $task = Task::orderBy('id', 'desc')->get(['id', 'description', 'completed']);
    return response()->json([
      'status' => true,
      "Task" => $task
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UpdateTaskRequest $request)
  {
    DB::beginTransaction();

    try {

      $task = Task::create([
        'description' => $request->description
      ]);

      // throw new Exception();

      $task = [
        'id' => $task->id,
        'description' => $task->description,
        'completed' => $task->completed,
      ];


      DB::commit();

      return response()->json([
        'status' => true,
        "message" => 'Tarefa cadastrada com sucesso',
        'task' => $task,
      ], 201);

    } catch (Exception $e) {

      DB::rollBack();

      return response()->json([
        'status' => false,
        "message" => 'Tarefa não cadastrada'
      ], 400);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Task $task)
  {
    return response()->json([
      'task' => $task
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Task $task)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTaskRequest $request, Task $task)
  {
    DB::beginTransaction();

    try {
      $task->update([
        'description' => $request->description,
        'completed' => $request->completed
      ]);
      DB::commit();

      // throw new Exception();

      return response()->json([
        'status' => true,
        "message" => 'Tarefa editada com sucesso'
      ], 200);

    } catch (Exception $e) {

      DB::rollBack();

      return response()->json([
        'status' => false,
        "message" => 'Tarefa não atualizada'
      ], 400);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Task $task)
  {
    DB::beginTransaction();

    try {

      $task->delete();

      // throw new Exception();
      DB::commit();
      return response()->json([
        'status' => true,
        "message" => 'Tarefa deletada com sucesso'
      ], 200);

    } catch (Exception $e) {

      DB::rollBack();

      return response()->json([
        'status' => false,
        "message" => 'Tarefa não deletada'
      ], 400);
    }
  }
}
