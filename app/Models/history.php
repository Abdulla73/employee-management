<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'histories';  // Change table name here if it's different
    protected $fillable = ['empId', 'institute', 'serving_year','position','special_award'];

}
