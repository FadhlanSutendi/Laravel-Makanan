<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class makanan extends Model
{
    use HasFactory;

    protected $table = 'makanans';

    protected $fillable = [
        'name', 
        'harga', 
        'kategori', 
        'deskripsi'];

        public function orders()
        {
            return $this->hasMany(Order::class);
        }
}   
