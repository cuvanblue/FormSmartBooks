<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Category;

class CategoryRepository extends BaseEloquentRepository
{
    function model()
    {
        return Category::class;
    }
}