<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'status', 'balance'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }


    public function getStatAttribute()
    {
        if ($this->status == 0) {
            return 'Preparing';
            # code...
        } elseif($this->status == 1){
            return 'Submitted';
        } else {
            return 'Done';
        }
    }

    public function getStatColorAttribute()
    {
        if ($this->status == 0) {
            return 'bg-yellow-100 text-yellow-800';
            # code...
        } elseif($this->status == 1){
            return 'bg-blue-100 text-blue-800';
        } else {
            return 'bg-green-100 text-green-800';
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_products')->withPivot('quantity');
    }


    public function getTotalPrice()
    {
        $sum = 0;
        foreach($this->products as $product){
            $sum += $product->price * $product->pivot->quantity;

        }
        return $sum;

    }


}
