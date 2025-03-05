<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'catalog_id',
        'tanggal_order',
        'durasi',
        'waktu_mulai',
        'waktu_selesai',
        'harga',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    
}
