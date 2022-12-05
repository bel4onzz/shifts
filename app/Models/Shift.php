<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'employee',
        'employer',
        'hours',
        'rate_per_hours',
        'shift_type',
        'taxable',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];
    protected function ratePerHours(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return floatval(str_replace('£', '', $value));
            },
        );
    }
    protected function date(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return date('d-m-Y', strtotime($value));;
            },
        );
    }
}
