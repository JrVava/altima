<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $table = 'frame';
    protected $fillable = [
        'frame',
        'left',
        'right',
        'top',
        'bottom',
    ];
}
