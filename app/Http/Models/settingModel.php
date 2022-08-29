<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class settingModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'setting_id';

    public $timestamps = false;

    public function getID($id){
        return self::where('setting_id', $id)->get();
    }
}
