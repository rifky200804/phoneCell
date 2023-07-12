<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'stok',
        'description',
        'foto',
        'brand_id',
        'categories_id',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id';
}
