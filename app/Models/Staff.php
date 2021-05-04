<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Staff extends Model
{
    use HasFactory, SoftDeletes, LogsActivity ;

    protected $fillable = [
        "staff_id",
        "title",
        "surname",
        "other_names",
        "email"
    ];

    protected $appends = [
        'full_name'
    ];

    protected static $logAttributes = ['title', "surname", "other_names" ,'staff_id', "email"];

    protected static $logName = 'staff';

    protected static $logOnlyDirty = true;


    public function getFullNameAttribute()
    {
        return Str::of($this->title . ' ' . $this->other_names . ' ' . $this->surname)->lower()->title() ;
    }

    /**
     * Get the Staff login details that owns the user Account.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the Staff office affiliations details.
     */
    public function offices()
    {
        return $this->belongsToMany(Office::class)
            ->withTimestamps()
            ->withPivot('start_date', 'end_date');
    }

    public function getCurrentOfficeAttribute()
    {
        return $this->offices? $this->offices->where('pivot_end_date', null)->sortByDesc('pivot_start_date')->first(): null;
    }
}
