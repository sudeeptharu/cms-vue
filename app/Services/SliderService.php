<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\SliderRepositoryInterface;

class SliderService
{
    public function __construct(private readonly SliderRepositoryInterface $sliderRepository)
    {

    }
    public function getAllSliders($paginator)
    {
        return $this->sliderRepository->getAllSliders($paginator);
    }
    public function create($request)
    {
        $data=[
            'order'=>$request['order'],
            'image'=>$request['image'],
            'url'=>$request['url'],
            'is_published'=>$request['is_published'],
            'title'=>$request['title'],
            'description'=>$request['description'],
        ];
        $slider= $this->sliderRepository->create($data);
        if(!$slider) throw new CustomException('failed to store');
        return $slider;

    }
    public function update($request)
    {
        $data=[
            'order'=>$request['order'],
            'image'=>$request['image'],
            'url'=>$request['url'],
            'is_published'=>$request['is_published'],
            'title'=>$request['title'],
            'description'=>$request['description'],
        ];
        $slider=$this->sliderRepository->update($request['id'],$data);
        if (!$slider) throw new CustomException('could not found id');
        return $slider;
    }
    public function destroy($id)
    {
        $delete= $this->sliderRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found slider');
        return $delete;
    }

}
