<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    protected $table = 'order';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}