<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['name', 'nim', 'email'];
    protected $table = 'mahasiswa';
}
