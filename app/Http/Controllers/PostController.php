<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\SuccessMessage;

class PostController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(PostService $postService,)
    {
        $posts = $postService->getAllPosts(20);
        return PostResource::collection($posts);
//        return view('dashboard.pages.posts',compact('posts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostService $postService,PostStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $postService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('Post'),Response::HTTP_CREATED);

        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request,PostService $postService)
    {
        try {
            DB::beginTransaction();
            $postService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('Post'),Response::HTTP_CREATED);
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostService $postService,$id)
    {
        try {
            DB::beginTransaction();
            $postService->destroyPost($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMEssage('Post'),Response::HTTP_CREATED);

        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }
}
