<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\LinkStoreRequest;
use App\Http\Requests\LinkUpdateRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Services\LinkService;
use App\Traits\SuccessMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use SuccessMessage;
    public function index(LinkService $linkService)
    {
        $links= $linkService->getALlLinks(20);
        return LinkResource::collection($links);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkService $linkService,LinkStoreRequest $request)
    {

        try {
            DB::beginTransaction();
            $linkService->create($request->validated());
            DB::commit();
            [$msg,$status]=array($this->getSuccessMessage('Link'),Response::HTTP_CREATED);
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]= array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LinkUpdateRequest $request, LinkService $linkService)
    {
        try {
            DB::beginTransaction();
            $linkService->update($request->validated());
            DB::commit();
            [$msg,$status]=array($this->getUpdateSuccessMessage('Link'),Response::HTTP_CREATED);

        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $exception){
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return \response()->json([$msg,$status]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,LinkService $linkService)
    {
        try {
            DB::beginTransaction();
            $linkService->destroy($id);
            DB::commit();
            [$msg,$status]=array($this->getDestroySuccessMEssage('Link'),Response::HTTP_CREATED);
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (\Exception $exception){
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return \response()->json([$msg,$status]);
    }
}
