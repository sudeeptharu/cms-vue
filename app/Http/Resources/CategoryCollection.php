<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return [
            'data' => $this->collection->map(function ($category){
                return new CategoryResource($category);
            }),
            'links' => [
                'self' => 'http://cmsrepo/api/category'
            ],
            'meta-data' => [
                'yess'=>'is yess'
            ]
        ];
    }

}
