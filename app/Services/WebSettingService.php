<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\WebSettingRepositoryInterface;

class WebSettingService
{

    public function __construct(private readonly WebSettingRepositoryInterface $webSettingRepository)
    {

    }
    public function getAllWebSettings($paginator)
    {
        return $this->webSettingRepository->getAllwebSettings($paginator);
    }
    public function create($request)
    {
        $data=[
            'key'=>$request['key'],
            'value'=>$request['value'],
            'image'=>$request['image'],
            'align'=>$request['align']
        ];
        $webSetting= $this->webSettingRepository->create($data);
        if(!$webSetting) throw new CustomException('failed to store');
        return $webSetting;

    }
    public function update($request)
    {
        $data=[
            'key'=>$request['key'],
            'value'=>$request['value'],
            'image'=>$request['image'],
            'align'=>$request['align']
        ];
        $webSetting=$this->webSettingRepository->update($request['id'],$data);
        if (!$webSetting) throw new CustomException('could not found id');
        return $webSetting;
    }
    public function destroy($id)
    {
        $delete= $this->webSettingRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found webSetting');
        return $delete;
    }
}
