<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\VideoRepositoryInterface;

class VideoService
{

    public function __construct(private readonly VideoRepositoryInterface $videoRepository)
    {

    }
    public function getAllVideos($paginator)
    {
        return $this->videoRepository->getAllVideos($paginator);
    }
    public function create($request)
    {
        $data=[
            'url'=>$request['url'],
            'title'=>$request['title']
        ];
        $video= $this->videoRepository->create($data);
        if(!$video) throw new CustomException('failed to store');
        return $video;

    }
    public function update($request)
    {
        $data=[
            'url'=>$request['url'],
            'title'=>$request['title']
        ];
        $video=$this->videoRepository->update($request['id'],$data);
        if (!$video) throw new CustomException('could not found id');
        return $video;
    }
    public function destroy($id)
    {
        $delete= $this->videoRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found Video');
        return $delete;
    }
}
