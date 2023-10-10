<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\WebSettingStoreRequest;
use App\Http\Requests\WebSettingUpdateRequest;
use App\Http\Resources\WebSettingResource;
use App\Models\WebSetting;
use App\Services\WebSettingService;
use Illuminate\Http\Request;
use App\Traits\SuccessMessage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class WebSettingController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(WebSettingService $webSettingService)
    {
        $web=$webSettingService->getAllWebSettings(10);
        return WebSettingResource::collection($web);
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
    public function store(WebSettingService $webSettingService,WebSettingStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $webSettingService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('webSetting'),Response::HTTP_CREATED);
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
    public function show(WebSetting $webSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebSetting $webSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WebSettingService $webSettingService,WebSettingUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $webSettingService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('webSetting'),Response::HTTP_CREATED);
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
    public function destroy(WebSettingService $webSettingService,$id)
    {
        try {
            DB::beginTransaction();
            $webSettingService->destroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMessage('webSetting'),Response::HTTP_CREATED);
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
