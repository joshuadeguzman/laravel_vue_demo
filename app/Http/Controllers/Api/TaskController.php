<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends BaseApiController
{


    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tasks = DB::table('tasks')
            ->where('tasks.user_id', Auth::user()->id)
            ->orderBy('tasks.created_at', 'DESC')
            ->get();

        // Retrieve tags each tasks
        foreach($tasks as $task){
            $task->tags = DB::table('task_tags')
                ->join('tags','tags.id','=','task_tags.tag_id')
                ->where('task_tags.task_id', $task->id)
                ->get();
        }

        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return TaskResource
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return TaskResource
     */
    public function edit($id)
    {
        // TODO: Add middleware here to prevent other authenticated (logged in) users to view other user's todo list tasks
        $task = DB::table('tasks')
            ->where('id', $id)
            ->select('id', 'name', 'description')
            ->first();

        return json_encode($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return TaskResource
     */
    public function update(Request $request, $id)
    {

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->modelDeleted('Task');
    }
}
