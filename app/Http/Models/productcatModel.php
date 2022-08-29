<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class productcatModel extends Model
{
    protected $table = 'product_to_category';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}