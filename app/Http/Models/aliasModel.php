<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class aliasModel extends Model
{
    protected $table = 'url_alias';
    public $timestamps = false;
    protected $primaryKey = 'url_alias_id';
}