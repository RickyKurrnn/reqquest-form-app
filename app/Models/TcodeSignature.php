<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcodeSignature extends Model
{
    use HasFactory;

    protected $table = 'tcode_signatures';

    protected $fillable = [
        'tcode_form_id',
        'role',
        'name',
        'signature_path',
    ];

    public function form()
    {
        return $this->belongsTo(TcodeForm::class, 'tcode_form_id');
    }
}
