<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public const PAYMENT_COD = 'cod';
    public const PAYMENT_BANK = 'bank_transfer';
    public const PAYMENT_UNPAID = 'unpaid';
    public const PAYMENT_PAID = 'paid';
    public const PAYMENT_REFUNDED = 'refunded';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPING = 'shipping';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    protected $fillable = [
        'code',
        'customer_name',
        'phone',
        'email',
        'address',
        'note',
        'subtotal',
        'shipping_fee',
        'discount',
        'total',
        'payment_method',
        'payment_status',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
