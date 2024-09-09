<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextFM extends Model
{
    use HasFactory;
    protected $fillable = ['content'];
}
