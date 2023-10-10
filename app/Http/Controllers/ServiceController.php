<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\SuccessMessage;
class ServiceController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceService $serviceService)
    {
        $service=$serviceService->getAllServices(10);
        return ServiceResource::collection($service);
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
    public function store(ServiceStoreRequest $request,ServiceService $serviceService)
    {
        try {
            DB::beginTransaction();
            $serviceService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('service'),Response::HTTP_CREATED);
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

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, ServiceService $serviceService)
    {
        try {
            DB::beginTransaction();
            $serviceService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('service'),Response::HTTP_CREATED);
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
    public function destroy( ServiceService $serviceService,$id)
    {
        try {
            DB::beginTransaction();
            $serviceService->destroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMessage('service'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage( ),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }
}
