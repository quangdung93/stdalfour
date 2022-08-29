<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class articlesdetailModel extends Model
{
    protected $table = 'articles_detail';
    public $timestamps = false;
    protected $primaryKey = 'ARTICLESID';
}