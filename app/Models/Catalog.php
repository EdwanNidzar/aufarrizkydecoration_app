<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'catalogs';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'image'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
