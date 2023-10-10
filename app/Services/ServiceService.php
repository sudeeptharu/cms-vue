<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceService
{

    public function __construct(private readonly ServiceRepositoryInterface $serviceRepository)
    {

    }

    public function getAllServices($paginator)
    {
        return $this->serviceRepository->getAllServices($paginator);
    }
    public function create($request)
    {
        $data=[
            'title'=>$request['title'],
            'icon'=>$request['icon'],
            'image'=>$request['description'],
            'excerpt'=>$request['excerpt'],
            'description'=>$request['description']
        ];
        $service= $this->serviceRepository->create($data);
        if(!$service) throw new CustomException('failed to store');
        return $service;

    }
    public function update($request)
    {
        $data=[
            'title'=>$request['title'],
            'icon'=>$request['icon'],
            'image'=>$request['description'],
            'excerpt'=>$request['excerpt'],
            'description'=>$request['description']
        ];
        $service=$this->serviceRepository->update($request['id'],$data);
        if (!$service) throw new CustomException('could not found id');
        return $service;
    }
    public function destroy($id)
    {
        $delete= $this->serviceRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found service');
        return $delete;
    }
}
