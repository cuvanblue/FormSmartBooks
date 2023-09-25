<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\ProductItem;

class ProductItemRepository extends BaseEloquentRepository
{
    function model()
    {
        return ProductItem::class;
    }
}