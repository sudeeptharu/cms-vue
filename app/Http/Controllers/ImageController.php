<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Services\ImageService;
use App\Traits\SuccessMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(ImageService $imageService)
    {
        $image=$imageService->getAllImages(4);
        return ImageResource::collection($image);
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
    public function store(ImageService $imageService,ImageStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $imageService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('image'),Response::HTTP_CREATED);
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
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageService $imageService,ImageUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $imageService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('image'),Response::HTTP_CREATED);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageService $imageService,$id)
    {
        try {
            DB::beginTransaction();
            $imageService->destroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMessage('image'),Response::HTTP_CREATED);
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
}
