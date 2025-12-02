<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSignature extends Model
{
    protected $fillable = [
        'request_form_id',
        'role',
        'name',
        'position',
        'date',
        'signature_path'
    ];

    public function form()
    {
        return $this->belongsTo(RequestForm::class);
    }
}
