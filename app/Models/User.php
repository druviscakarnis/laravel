<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user_datas';

    protected $fillable = ['username','password'];

}
