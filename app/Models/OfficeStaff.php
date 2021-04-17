<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeStaff extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $fillable = [
        "office_id",
        "staff_id",
        "start_date",
        "end_date"
    ];
}
