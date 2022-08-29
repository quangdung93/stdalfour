<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}