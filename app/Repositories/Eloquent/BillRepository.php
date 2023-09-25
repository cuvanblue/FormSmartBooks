<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Bill;

class BillRepository extends BaseEloquentRepository
{
    function model()
    {
        return Bill::class;
    }
}