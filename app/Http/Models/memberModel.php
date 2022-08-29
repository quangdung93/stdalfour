<?php

namespace App\Http\Models;

use DB;
use Custom;
use Illuminate\Database\Eloquent\Model;

class memberModel extends Model
{
    protected $table = '';

    public function __construct()
    {
        $this->table = 'users';
    }

    public function memberListRecord($data, $getAll = 0)
    {
        $querySql = DB::table($this->table);
        Custom::build_sql_where($querySql, $data);
        if (!$getAll) {
            $rowlist = $querySql->paginate($data['limit']);
        } else {
            if ($getAll == 2) {
                // Get Limit
                $querySql->limit($data['limit']);
            }
            $rowlist = $querySql->get();
        }
        return $rowlist;
    }

    public function memberRecord($idMem)
    {
        $querySql = DB::table($this->table);
        $querySql->Where('iduser', $idMem);
        $rowlist = $querySql->first();

        return $rowlist;
    }

    public function memberInforRecord($data)
    {
        $querySql = DB::table($this->table);
        Custom::build_sql_where($querySql, $data);
        $rowlist = $querySql->first();
        return $rowlist;
    }

    public function editRecord($id, $data)
    {
        $querySql = DB::table($this->table);
        $querySql->Where('iduser', $id)->Update($data);
    }

    public function editRecordQuery($whereSql, $data)
    {
        $querySql = DB::table($this->table);
        Custom::build_sql_where($querySql, $whereSql);
        $querySql->Update($data);
    }
}
