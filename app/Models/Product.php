<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'amount','category_id'];


    public function category()
    {
        // Importante: si tu modelo se llama 'categories' (en plural), ponlo así:
        return $this->belongsTo(categories::class, 'category_id');
    }

    public function reduceStock($quantity)
{
    if ($this->amount < $quantity) {
        return false;
    }

    return $this->decrement('amount', $quantity);
}


}
