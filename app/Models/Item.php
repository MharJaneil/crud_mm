<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $collection = 'item';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        
    ];
}
