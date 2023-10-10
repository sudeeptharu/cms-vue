<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\ScrollerRepositoryInterface;

class ScrollerService
{

public function __construct(private readonly ScrollerRepositoryInterface $scrollerRepository)
{

}
    public function getAllScrollers($paginator)
    {
        return $this->scrollerRepository->getAllScrollers($paginator);
    }
    public function create($request)
    {
        $data=[
            'title'=>$request['title'],
            'url'=>$request['url']

        ];
        $scroller= $this->scrollerRepository->create($data);
        if(!$scroller) throw new CustomException('failed to store');
        return $scroller;

    }
    public function update($request)
    {
        $data=[
            'title'=>$request['title'],
            'url'=>$request['url']
        ];
        $scroller=$this->scrollerRepository->update($request['id'],$data);
        if (!$scroller) throw new CustomException('could not found id');
        return $scroller;
    }
    public function destroy($id)
    {
        $delete= $this->scrollerRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found scroller');
        return $delete;
    }
}
