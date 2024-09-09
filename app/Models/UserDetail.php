<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'users_details';
    protected $fillable = [
        'user_id',
        'poster',
        'doctor_name',
        'speciality',
        'place',
        'frame_id'
    ];
}
