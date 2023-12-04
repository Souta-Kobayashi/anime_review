<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRatingRequest;
use App\Http\Resources\VideoResource;
use App\UseCases\Video\StoreAction;
use App\UseCases\Video\DestroyAction;
use App\UseCases\Video\UpdateRatingAction;
use App\Exceptions\DatabaseUpdateException;
use Throwable;

class VideoController extends Controller
{
    private Video $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

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

    public function update_rating(UpdateRatingRequest $request, UpdateRatingAction $action,  string $id): VideoResource
    {
        try {
            $review_rating = $request->make_rating();
            return new VideoResource($action($review_rating, $this->video, $id));
        } catch (Throwable $e) {
            throw new DatabaseUpdateException('レビュー');
        }
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
