<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\MenuRepositoryInterface;

class MenuService
{
    public function __construct(private readonly MenuRepositoryInterface $menuRepository)
    {

    }
    public function getAllMenus($paginator)
    {
        return $this->menuRepository->getAllMenus($paginator);
    }
    public function create($request)
    {
        $data=[
            'title'=>$request['title'],
            'order'=>$request['order'],
            'url'=>$request['url'],
            'is_published'=>$request['is_published'],
            'opens_in_new_tab'=>$request['opens_in_new_tab'],
            'parent_id'=>$request['parent_id']
        ];
        $menu= $this->menuRepository->create($data);
        if(!$menu) throw new CustomException('failed to store');
        return $menu;

    }
    public function update($request)
    {
        $data=[
            'title'=>$request['title'],
            'order'=>$request['order'],
            'url'=>$request['url'],
            'is_published'=>$request['is_published'],
            'opens_in_new_tab'=>$request['opens_in_new_tab'],
            'parent_id'=>$request['parent_id']
        ];
        $menu=$this->menuRepository->update($request['id'],$data);
        if (!$menu) throw new CustomException('could not found id');
        return $menu;
    }
    public function destroy($id)
    {
        $delete= $this->menuRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found menu');
        return $delete;
    }

}
