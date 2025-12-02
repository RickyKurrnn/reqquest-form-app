<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    protected $fillable = [
        'request_type',
        'application_name',
        'request_date',
        'existing_condition',
        'expectations',
        'type',
        'notes'
    ];

    public function signatures()
    {
        return $this->hasMany(RequestSignature::class);
    }
}

