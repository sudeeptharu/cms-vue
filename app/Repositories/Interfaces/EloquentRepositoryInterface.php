<?php

namespace App\Repositories\Interfaces;

interface EloquentRepositoryInterface
{
    public function all(array $cols = null);
    public function create(array $attributes);

}
