<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkouts';
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id';
}
