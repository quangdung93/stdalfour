<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class catModel extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    protected $primaryKey = 'ID';
}