<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSibuk extends Model
{
    use HasFactory;
    public function counselor()
    {
        return $this->belongsTo(User::class,'counselor_id');
    }
}
