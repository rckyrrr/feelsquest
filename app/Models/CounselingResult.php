<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingResult extends Model
{
    use HasFactory;
    public function counseling()
    {
        return $this->belongsTo(counseling::class);
    }
}
