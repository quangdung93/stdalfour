<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class catdetailModel extends Model
{
    protected $table = 'category_detail';
    public $timestamps = false;
    protected $primaryKey = 'CATEGORYID';
}