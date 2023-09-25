<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\User;

class UserRepository extends BaseEloquentRepository
{
    function model()
    {
        return User::class;
    }
}