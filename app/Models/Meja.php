<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'no_meja',
        'created_at',
        'updated_at'
    ];

    protected $table = 'meja';

    // Define relationship with OrderItems
    public function order()
    {
        return $this->hasOne(Order::class, 'meja_id', 'id')
                ->where('status', 1)
                ->orderBy('created_at', 'desc');
    }
}
