<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'brand', 'category', 'price', 'updated_at', 'created_at'
    ];


    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_products');
    }



}
