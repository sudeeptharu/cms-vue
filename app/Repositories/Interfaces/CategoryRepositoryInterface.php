<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategories($paginator);
}
