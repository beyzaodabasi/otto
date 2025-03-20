<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        '_id',
        'orderNumber',
        'customerCode',
        'productDetails',
        'productDescription',
        'orderDate',
        'dueDate',
        'personnelCode',
        'personnelName',
        'companyName',
        'description',
        'orderStatus',
        'shippingDate',
        'note',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('status', 'quantity');
    }

    // ORDER->Sipariş
    public function orderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('status', 'quantity')
            ->wherePivot('status', 'ORDER');
    }

    // MANUFACTURING->İmalat
    public function manufacturingOrderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('status', 'quantity')
            ->wherePivot('status', 'MANUFACTURING');
    }

    // ASSEMBLY->Montaj
    public function assemblyOrderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('status', 'quantity')
            ->wherePivot('status', 'ASSEMBLY');
    }

    // ACCOUNTING->Muhasebe
    public function accountingOrderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('status', 'quantity')
            ->wherePivot('status', 'ACCOUNTING');
    }

    // SHIPPING->Kargo
    public function shippingOrderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('status', 'quantity')
            ->wherePivot('status', 'SHIPPING');
    }

}