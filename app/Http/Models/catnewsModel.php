<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class catnewsModel extends Model
{
    protected $table = 'category_news';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}