<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class newsModel extends Model
{
    protected $table = 'news';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}