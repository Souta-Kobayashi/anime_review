<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Resources\VideoResource;
use App\UseCases\Video\StoreAction;
use App\UseCases\Video\DestroyAction;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action): VideoResource
    {
        $video = $request->make_video($request->validated());
        return new VideoResource($action($video));
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Video $video, DestroyAction $action)
    {
        return new VideoResource($action($video, $id));
    }
}
