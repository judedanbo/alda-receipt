<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class OfficeStaff extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    
    protected $fillable = [
        "office_id",
        "staff_id",
        "start_date",
        "end_date"
    ];

    protected static $logAttributes = [
        "office_id",
        "staff_id",
        "start_date",
        "end_date"
    ];

    protected static $logName = 'office-staff-relation';

    protected static $logOnlyDirty = true;
}
