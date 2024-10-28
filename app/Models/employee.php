<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'empId';
    protected $fillable = ['name', 'email', 'dob', 'phone', 'address', 'profile_image'];
}
