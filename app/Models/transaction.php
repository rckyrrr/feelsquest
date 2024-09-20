<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    public function package()
    {
        return $this->belongsTo(package::class);
    }

    public function counseling()
    {
        return $this->hasMany(counseling::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function klien()
    {
        return $this->belongsTo(User::class,'klien_id');
    }
}
