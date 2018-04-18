<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TagResource;
use App\Tag;
use App\TaskTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TagController extends BaseApiController
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

        // Initialize tags
        $tags = [];

        // Get ranked tags
        $tagsRanked = DB::table('tags')
            ->join('task_tags', 'task_tags.tag_id', '=', 'tags.id')
            ->select('tags.id', DB::raw('COUNT(tags.id) as count'))
            ->groupBy('tags.id')
            ->orderBy(DB::raw('COUNT(tags.id)'), 'DESC')
            ->limit(3)
            ->get();


        // Assign ranked tags ids
        $tagsRankedIds = [];
        foreach ($tagsRanked as $key => $value) {
            array_push($tagsRankedIds, $value->id);

            // TODO: Covert to an efficient query, possibly merge with the previous tags ranked query
            $value->name = DB::table('tags')->where('id', $value->id)->first()->name;
        }

        return TagResource::collection($tagsRanked);
    }


    public function getTaskTags($id){
        $taskTags = DB::table('task_tags')
            ->join('tags','tags.id','=','task_tags.tag_id')
            ->where('task_tags.task_id', $id)
            ->get();

        return TagResource::collection($taskTags);
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
     * @param Request $request
     * @param $id
     * @return string
     */
    public function store(Request $request, $id)
    {
        // Remove all tags related to the task
        $taskTags = TaskTag::where('task_id', $id)->delete();

        // Re-add the old tags and add new tag instances to the task
        foreach ($request->all() as $key => $value) {
            // Check whether the tag with the name already exists
            $tag = DB::table('tags')
                ->where('name', $value['name'])
                ->first();

            if (!$tag) {
                // Create tag instance
                $tag = new Tag();
                $tag->name = $value['name'];
                $tag->save();
            }

            // Bind tag to the task
            $taskTags = new TaskTag();
            $taskTags->task_id = $id;
            $taskTags->tag_id = $tag->id;
            $taskTags->save();
        }

        // TODO: Internally validate tags being added, binded with the task
        return $this->ok($taskTags);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
