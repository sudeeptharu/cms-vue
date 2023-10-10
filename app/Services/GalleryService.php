<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\GalleryRepositoryInterface;

class GalleryService
{
    public function __construct(private readonly GalleryRepositoryInterface $galleryRepository)
    {

    }
    public function getAllGalleries($paginator)
    {
        return $this->galleryRepository->getAllGalleries($paginator);
    }
    public function create($request)
    {
        $data=[
            'title'=>$request['title'],
            'description'=>$request['description'],
            'is_published'=>$request['is_published']
        ];
        $gallery= $this->galleryRepository->create($data);
        if(!$gallery) throw new CustomException('failed to store');
        return $gallery;

    }
    public function update($request)
    {
        $data=[
            'title'=>$request['title'],
            'description'=>$request['description'],
            'is_published'=>$request['is_published']
        ];
        $gallery=$this->galleryRepository->update($request['id'],$data);
        if (!$gallery) throw new CustomException('could not found id');
        return $gallery;
    }
    public function destroy($id)
    {
        $delete= $this->galleryRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found gallery');
        return $delete;
    }

}
