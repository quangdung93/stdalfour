<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class newsdetailModel extends Model
{
    protected $table = 'news_detail';
    public $timestamps = false;
    protected $primaryKey = 'NEWSID';
}