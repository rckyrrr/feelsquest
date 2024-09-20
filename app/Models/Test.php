<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function result()
    {
        return $this->hasMany(TestResult::class);
    }

    public function question()
    {
        return $this->hasMany(TestQuestion::class);
    }
}
