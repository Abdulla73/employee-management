<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = ['name', 'email', 'dob', 'phone', 'address', 'profile_image'];

    public function educations(){
        return $this->hasMany(Education::class, 'empId');
    }

    public function histories(){
        return $this->hasMany(History::class, 'empId');
    }
}
