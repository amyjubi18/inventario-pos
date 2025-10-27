<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'products',
        'warehouse_id',
        'total',
        'payment_method',
        'amount_paid',
        'change',
        'quote_id'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'change' => 'decimal:2',
        'products' => 'array'
    ];

    // Relaciones
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
