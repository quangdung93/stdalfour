<?php

namespace App\Models;

use App\Http\Models\productModel;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(productModel::class, 'product_id', 'ID')
        ->join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')
        ->where('product.STATUS',1);
    }
}