<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'created_at',
        'updated_at'
    ];

    protected $table = 'kategori';

    // Define relationship with OrderItems
    public function menu()
    {
        return $this->hasMany(Menu::class, 'kategori_id', 'id');
    }
}
