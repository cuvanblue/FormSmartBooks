<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository extends BaseEloquentRepository
{
    function model()
    {
        return ProductCategory::class;
    }

}