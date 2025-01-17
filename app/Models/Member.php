<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $appends = ['full_name'];

    public function getFullNameAttribute($value)
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
