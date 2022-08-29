<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class productdetailModel extends Model
{
    protected $table = 'product_detail';
    public $timestamps = false;
    protected $primaryKey = 'PRODUCTID';
}