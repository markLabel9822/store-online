<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailedOrder extends Model
{
    use HasFactory;

    protected $fillable = ['id_product', 'product_name', 'product_price'];

    public function mainOrder()
    {
        return $this->belongsTo(MainOrder::class);
    }
}
