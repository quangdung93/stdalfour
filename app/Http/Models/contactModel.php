<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class contactModel extends Model
{
    protected $table = 'contact';
    public $timestamps = false;
    protected $primaryKey = 'contact_id';
}