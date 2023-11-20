<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Services\PageService;
use App\Traits\SuccessMessage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(PageService $pageService)
    {
        $page=$pageService->getAllPages(10);
        return PageResource::collection($page);
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
    public function store(PageService $pageService,PageStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $pageService->create($request->validated());
            DB::commit();
            [$msg,$status]=array(
                $this->getSuccessMEssage('Page'),
                Response::HTTP_CREATED
            );
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $exception){
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($msg,$status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getPageById(PageService $pageService,$id)
    {
        try{
            DB::beginTransaction();
            $page=$pageService->getPageById($id);
            DB::commit();
            [$msg,$status]=array($page,Response::HTTP_CREATED);
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json($msg,$status);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, PageService $pageService)
    {
        try {
            DB::beginTransaction();
            $pageService->update($request->validated());
            DB::commit();
            [$msg,$status]=array(
                $this->getUpdateSuccessMEssage('Page'),
                Response::HTTP_CREATED
            );
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json($msg,$status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,PageService $pageService)
    {
        try {
            DB::beginTransaction();
            $pageService->destroyPage($id);
            [$msg,$status]=array(
                $this->getDestroySuccessMEssage('Page'),
                Response::HTTP_CREATED
            );
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $exception){
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($msg,$status);
    }
}
