<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\BillDetail;

class BillDetailRepository extends BaseEloquentRepository
{
    function model()
    {
        return BillDetail::class;
    }
}