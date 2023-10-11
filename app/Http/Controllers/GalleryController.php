<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\SuccessMessage;
class GalleryController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(GalleryService $galleryService)
    {
        $gallery=$galleryService->getAllGalleries(5);
        return GalleryResource::collection($gallery);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryStoreRequest $request,GalleryService $galleryService)
    {
        try {
            DB::beginTransaction();
            $galleryService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('gallery'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryService $galleryService,GalleryUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $galleryService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('gallery'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryService $galleryService,$id)
    {
        try {
            DB::beginTransaction();
            $galleryService->destroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMessage('gallery'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage('something went wrong'),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }
}
