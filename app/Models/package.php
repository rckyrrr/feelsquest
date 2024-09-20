<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;

    public function transaction()
    {
        return $this->hasMany(transaction::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'package_feature');
    }
}
