<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class mediaModel extends Model
{
    protected $table = 'media';
    public $timestamps = false;
    protected $primaryKey = 'media_id';
}