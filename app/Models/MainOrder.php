<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainOrder extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'telephone', 'shipping_address', 'billing_address', 'price_summary', 'total_amount', 'status'];

    public function detailedOrders()
    {
        return $this->hasMany(DetailedOrder::class);
    }
}
