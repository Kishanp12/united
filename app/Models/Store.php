<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'state', 'city', 'address', 'phone', 'license', 'approved', 'country'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute()
    {
        return ($this->approved) ? 'Approved' : 'Not Approved';
    }

    public function getStatusColorAttribute()
    {
        return ($this->approved) ? 'bg-green-100 text-green-800': 'bg-red-100 text-red-800';
    }



}
