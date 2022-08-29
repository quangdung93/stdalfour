<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sliderModel extends Model
{
    protected $table = 'slider';
    protected $primaryKey = 'id';

    public $timestamps = false;

    function listSlides()
    {
        return self::where('status','=',1)
            ->orderBy(DB::raw('id*1'),'ASC')
            ->paginate();
    }
	function getSlides()
    {
        return self::where('status','=',1)
            ->orderBy(DB::raw('id*1'),'ASC')
            ->get();
    }
    public function slideMax()
    {
        return self::max('id');
    }

    public function getID($id){
        return self::where('id', $id)->get();
    }
}
