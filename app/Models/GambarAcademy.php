<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarAcademy extends Model
{
    use HasFactory;

    protected $table = 'gambar_academies'; // Ubah dari 'gambar_academy' ke 'gambar_academies'

    protected $fillable = [
        'gambar1',
        'gambar2',
    ];
}