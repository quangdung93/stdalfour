<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class commentsModel extends Model
{
    protected $table = 'binhluan';
    public $timestamps = false;
    protected $primaryKey = 'binhluan_id';
}