<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'status',
        'order_code',
        'price',
        'quantity',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
