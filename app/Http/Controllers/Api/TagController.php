<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TagResource;
use App\Tag;
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

        // Assign ranked tags
        $tags['ranked'] = $tagsRanked;

        // Get unranked tags
        $tagsUnranked = DB::table('tags')
            ->whereNotIn('id', $tagsRankedIds)
            ->select('id', 'name')
            ->get();

        // Assign unranked tags
        $tags['unranked'] = $tagsUnranked;

        return json_encode($tags);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
