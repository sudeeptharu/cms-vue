<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\PageRepositoryInterface;

class PageService
{

    public function __construct(private readonly PageRepositoryInterface $pageRepository)
    {

    }
    public function getAllPages(int $paginator)
    {
        return $this->pageRepository->getAllPages($paginator);
    }
    public function create($request)
    {
        $data = [
            'title' =>$request['title'],
            'subtitle' => $request['subtitle'],
            'description' => $request['description'],
            'quote' => $request['quote'],
            'excerpt' => $request['excerpt'],
            'draft' => $request['draft'],
            'image' => $request['image'],
            'slug' => $request['slug']
        ];
        $page=$this->pageRepository->create($data);
        if(!$page) throw new CustomException('cannot create');
        return $page;
    }
    public function update($request)
    {
        $data = [
            'title' =>$request['title'],
            'subtitle' => $request['subtitle'],
            'description' => $request['description'],
            'quote' => $request['quote'],
            'excerpt' => $request['excerpt'],
            'draft' => $request['draft'],
            'image' => $request['image'],
            'slug' => $request['slug']
        ];
        $page=$this->pageRepository->update($request['id'],$data);
        if(!$page) throw new CustomException('cannot find id');
        return $page;
    }
    public function getPageById($id)
    {
        $page= $this->pageRepository->getPageById($id);
        return $page;
    }
    public function destroyPage($id)
    {
        $destroy=$this->pageRepository->destroy($id);
        if($destroy!=1) throw new CustomException('id not found');
        return $destroy;
    }
}
