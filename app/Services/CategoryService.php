<?php

namespace App\Services;
use App\Exceptions\CustomException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Couchbase\QueryErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {

    }
    public function getAllCategories(int $paginator)
    {
        return $this->categoryRepository->getAllCategories($paginator);

    }
    public function categoryStore($request)
    {
        $data=[
            'title'=>$request['title'],
        ];
        $category= $this->categoryRepository->create($data);

        return $category;
    }
    public function categoryUpdate($request)
    {
        $data=[
            'title'=>$request['title'],
        ];
        return $this->categoryRepository->update($request['id'],$data);
    }
    public function categorydestroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }
    public function getCategoryByTitle($name)
    {
        $category = Category::where('title',$name)->first();
        if(!$category){
            throw new CustomException('name not found');
        }
    }
}
