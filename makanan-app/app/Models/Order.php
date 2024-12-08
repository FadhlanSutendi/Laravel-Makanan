<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['name', 'makanans', 'makanans_id', 'total_price'];

    protected $casts = [
        'makanans' => 'array',
    ];

    public function makanan()
    {
        return $this->belongsToMany(makanan::class);
    }
}
