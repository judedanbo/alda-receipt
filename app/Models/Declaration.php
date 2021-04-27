<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Declaration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'receipt_no',
        'declared_on',
        'declarant_name',
        'post',
        'schedule',
        'office_location',
        'address',
        'contact',
        'witness',
        'witness_occupation',
        'person_submitting',
        'person_submitting_contact',
        'user_id',
        'qrcode',
        'synced'
    ];
    
    protected $casts = [
        'declared_on' => 'date',
        'synced' => 'boolean'
    ];
     
    protected $hidden = [
        'synced'
    ];

    protected $appends = [
        'declared_on_display'
    ];

    public function enteredBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    

    public function getDeclaredOnDisplayAttribute()
    {
        return Carbon::parse($this->declared_on)->format('j F Y');
    }
}
