<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'gender',
        'school',
        'grade',
        'contactNumber'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F j, Y');
    }
}
