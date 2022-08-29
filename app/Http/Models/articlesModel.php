<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class articlesModel extends Model
{
    protected $table = 'articles';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}