<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Office extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable =[
        'office_id',
        'office_name'
    ];

    protected $casts =[
        'office-id' => 'integer'
    ];

    protected static $logAttributes = ['office_id', "office_name"];

    protected static $logName = 'office';

    protected static $logOnlyDirty = true;

    /**
     * Get all of the staff for the Office
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff()
    {
        return $this->belongsToMany(Staff::class)
            ->withTimestamps()
            ->withPivot('start_date', 'end_date');
    }

    /**
     * Get all of the declarations for the Office
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function declarations()
    {
        return $this->hasMany(Declaration::class);
    }
}
