<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table = 'bill_details';
    protected $fillable = [
        'bill_id',
        'product_id',
        'quanity',
        'last_modified_by'
    ];
}