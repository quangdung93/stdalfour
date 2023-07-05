<?php

namespace App\Models;

use App\Http\Models\productModel;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RatingReply extends Model
{
    protected $table = 'rating_replies';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'iduser');
    }
}