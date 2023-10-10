<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Services\CategoryService;
use Illuminate\Support\Facades\DB;
use App\Traits\SuccessMessage;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index( CategoryService $categoryService)
    {
        $category= $categoryService->getAllCategories(10);
        return new CategoryCollection($category);
//        return view('dashboard.pages.categories',compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryService $categoryService , CategoryStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $categoryService->categoryStore($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('Category'),Response::HTTP_CREATED);
//            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($this->getErrorMessage('something went wrong'),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryService $categoryService,CategoryUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $categoryService->categoryUpdate($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('Category'),Response::HTTP_CREATED);
//            return redirect('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status] = array($this->getErrorMessage('Something Went Wrong'),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryService $categoryService,$id)
    {
        try {
            DB::beginTransaction();
            $categoryService->categorydestroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMEssage('Category'),Response::HTTP_CREATED);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);

        }
        return response()->json([$msg,$status]);
//        return redirect('api/category');
    }
}
