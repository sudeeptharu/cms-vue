<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\ScrollerStoreRequest;
use App\Http\Requests\ScrollerUpdateRequest;
use App\Http\Resources\ScrollerResource;
use App\Models\Scroller;
use App\Services\ScrollerService;
use App\Traits\SuccessMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
class ScrollerController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(ScrollerService $scrollerService)
    {
        $scroller=$scrollerService->getAllScrollers(10);
        return ScrollerResource::collection($scroller);
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
    public function store(ScrollerStoreRequest $request,ScrollerService $scrollerService)
    {
        try {
            DB::beginTransaction();
                $scrollerService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('Scroller'),Response::HTTP_CREATED);
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
     * Display the specified resource.
     */
    public function show(Scroller $scroller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scroller $scroller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScrollerUpdateRequest $request, ScrollerService $scrollerService)
    {
        try {
            DB::beginTransaction();
            $scrollerService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('Scroller'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);

        }
        return response()->json([$msg,$status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScrollerService $scrollerService,$id)
    {
        try {
            DB::beginTransaction();
            $scrollerService->destroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMessage('Scroller'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status]=array($this->getErrorMessage('something went wrong'),Response::HTTP_INTERNAL_SERVER_ERROR);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        return response()->json([$msg,$status]);
    }
}
