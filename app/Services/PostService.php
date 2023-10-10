<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService
{
    public function __construct(private readonly PostRepositoryInterface $postRepository)
    {

    }
    public function getAllPosts($paginator)
    {
        return $this->postRepository->getAllPost($paginator);
    }
    public function create($request)
    {
        $data=[
            'title'=>$request['title'],
            'subtitle'=>$request['subtitle'],
            'excerpt'=>$request['excerpt'],
            'description'=>$request['description'],
            'quote'=>$request['quote'],
            'image'=>$request['image'],
            'draft'=>$request['draft']
        ];
        $post= $this->postRepository->create($data);
        if(!$post) throw new CustomException('failed to store');
        return $post;

    }
    public function update($request)
    {
        $data=[
            'title'=>$request['title'],
            'subtitle'=>$request['subtitle'],
            'excerpt'=>$request['excerpt'],
            'description'=>$request['description'],
            'quote'=>$request['quote'],
            'image'=>$request['image'],
            'draft'=>$request['draft']
        ];
        $post=$this->postRepository->update($request['id'],$data);
        if (!$post) throw new CustomException('could not found id');
            return $post;
    }
    public function destroyPost($id)
    {
        $delete= $this->postRepository->destroy($id);
        if($delete !=1) throw new CustomException('could not found post');
            return $delete;
    }
}
