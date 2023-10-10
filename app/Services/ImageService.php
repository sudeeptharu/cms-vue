<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageService
{
    public function __construct(private readonly ImageRepositoryInterface $imageRepository)
    {

    }
    public function getAllImages($paginator)
    {
        return $this->imageRepository->getAllimages($paginator);
    }
    public function create($request)
    {
        $data=[
            'gallery_id'=>$request['gallery_id'],
            'image'=>$request['image']
        ];
        $image= $this->imageRepository->create($data);
        if(!$image) throw new CustomException('failed to store');
        return $image;

    }
    public function update($request)
    {
        $data=[
            'gallery_id'=>$request['gallery_id'],
            'image'=>$request['image']
        ];
        $image=$this->imageRepository->update($request['id'],$data);
        if (!$image) throw new CustomException('could not found id');
        return $image;
    }
    public function destroy($id)
    {
        $delete= $this->imageRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found image');
        return $delete;
    }
}
