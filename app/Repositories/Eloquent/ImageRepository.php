<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Image;

class ImageRepository extends BaseEloquentRepository
{
    function model()
    {
        return Image::class;
    }
    function getThumbnails()
    {
        return Image::where('role', 'thumbnail')->get();
    }
}