<?php

namespace App\Http\Controllers;

use App\Exceptions\DatabaseUpdateException;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateInfoRequest;
use App\Http\Requests\Video\UpdateRatingRequest;
use App\Http\Resources\VideoResource;
use App\Models\Review;
use App\Models\Video;
use App\UseCases\Video\DestroyAction;
use App\UseCases\Video\IndexAction;
use App\UseCases\Video\ShowAction;
use App\UseCases\Video\StoreAction;
use App\UseCases\Video\UpdateInfoAction;
use App\UseCases\Video\UpdateRatingAction;
use Throwable;

class VideoController extends Controller
{
    private Video $video;

    private Review $review;

    public function __construct(Video $video, Review $review)
    {
        $this->video = $video;
        $this->review = $review;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexAction $action)
    {
        return VideoResource::collection($action());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action): VideoResource
    {
        $video = $request->make_video($request->validated());

        return new VideoResource($action($video, $this->review));
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowAction $action, string $id)
    {
        return new VideoResource($action($this->video, $id));
    }

    public function update_rating(UpdateRatingRequest $request, UpdateRatingAction $action, string $id): VideoResource
    {
        try {
            $review_items = $request->validated();

            return new VideoResource($action($this->video, $review_items, $id));
        } catch (Throwable $e) {
            throw new DatabaseUpdateException('レビュー');
        }
    }

    public function update_info(UpdateInfoRequest $request, UpdateInfoAction $action, string $id): VideoResource
    {
        try {
            $anime_info_item = $request->make_anime_info($request->validated());

            return new VideoResource($action($this->video, $anime_info_item, $id));
        } catch (Throwable $e) {
            throw new DatabaseUpdateException('アニメ情報');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Video $video, DestroyAction $action)
    {
        return new VideoResource($action($video, $id));
    }
}
