<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseEloquentRepository
{
    function model()
    {
        return Product::class;
    }
    function getProductsIndex()
    {
        return $result = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->where('role', 'thumbnail')
            ->select('*')
            ->get();
    }
    function getProductsByCategory($id)
    {
        return $result = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->where('role', 'thumbnail')
            ->join('product_category', 'products.id', '=', 'product_category.product_id')
            ->where('product_category.category_id', $id)
            ->get();
    }

}