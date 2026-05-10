<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['cliente_id','product_id','quantity','total'];

    public function Cliente(){

        return $this->belongsTo(Clientes::class, 'cliente_id');

    }


        public function Product(){

        return $this->belongsTo(Product::class, 'product_id');

    }


}
