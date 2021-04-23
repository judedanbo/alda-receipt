<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Staff extends Model
{
    use HasFactory, SoftDeletes ;

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
        return $this->belongsToMany(Office::class)->withTimestamps();
    }

    public function getCurrentOfficeAttribute()
    {
        return $this->offices->where('end_date', null)->order_by('start_date')->first();
    }

    
}
