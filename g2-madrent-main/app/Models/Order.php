<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['price','id','user_id', 'product_id'];

    public function products() {
        return $this->belongsToMany('App\Model\Product');
    }
}
