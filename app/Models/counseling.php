<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class counseling extends Model
{
    use HasFactory;

    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }

    public function counselor()
    {
        return $this->belongsTo(User::class);
    }
    public function klien()
    {
        return $this->belongsTo(User::class,'klien_id');
    }

    public function counselingResult()
    {
        return $this->hasOne(CounselingResult::class);
    }
}
