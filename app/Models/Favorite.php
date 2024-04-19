<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'favorites';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'doctor_id'
    ];
}
