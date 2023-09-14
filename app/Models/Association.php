<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function values() {
        return $this->hasMany(Value::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

}
