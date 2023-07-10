<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    protected $fillable = [
        'full_name',
        'email',
        'place_of_birth',
        'date_of_birth',
        'address'
    ];
    protected $primaryKey = 'id';
}
