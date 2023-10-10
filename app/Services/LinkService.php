<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Carbon\Exceptions\UnknownSetterException;

class LinkService
{
    public function __construct(private readonly LinkRepositoryInterface $linkRepository)
    {


    }
    public function getALlLinks(int $paginator)
    {
        return $this->linkRepository->getAllLinks($paginator);
    }
    public function create($request)
    {
        $data=[
            'social'=>$request['social'],
            'icon'=>$request['icon'],
            'url'=>$request['url']
        ];
        $link=$this->linkRepository->create($data);
        if(!$link) throw new CustomException('cannot create Link');
        return $link;
    }
    public function update($request)
    {
        $data=[
            'social'=>$request['social'],
            'icon'=>$request['icon'],
            'url'=>$request['url']
        ];
        $link=$this->linkRepository->update($request['id'],$data);
        if(!$link) throw new CustomException('id not found');
        return $link;
    }
    public function destroy($id)
    {
        $delete=$this->linkRepository->destroy($id);
        if(!$delete) throw new CustomException('id not found');
        return $delete;
    }
}
