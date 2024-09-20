<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function klien()
    {
        return $this->belongsTo(User::class,'klien_id');
    }
}
