<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextAcademy extends Model
{
    use HasFactory;

    // Add fillable property
    protected $fillable = ['text']; // Allow mass assignment for 'text'
}
