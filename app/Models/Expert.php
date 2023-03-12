<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Expert extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
          protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'experiences',
        'details',
        'phone_number',
        'address',
        'start_day',
        'end_day',
        'open',
        'close',
        'specialist_id',
    ];
}
