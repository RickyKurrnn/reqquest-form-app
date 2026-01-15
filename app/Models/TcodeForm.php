<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcodeForm extends Model
{
    use HasFactory;

    protected $table = 'tcode_forms';

    protected $fillable = [
        'created_by',
        'request_date',
        'document_number',
        'name',
        'company',
        'employee_id',
        'position',
        'sap_username',
        'division',
        'department',
        'email',
        'sap_module',
        'client',
        'request_description',
        'authorization_added',
        'requested_by',
        'approved_by',
        'added_by',
        'acknowledged_by',
        'attachment_path',
        'status',
    ];

    protected $casts = [
        'request_date'     => 'datetime',
        'authorization_added'      => 'datetime',
    ];

    public function signatures()
    {
        return $this->hasMany(TcodeSignature::class);
    }
}
