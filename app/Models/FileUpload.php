<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_key',
        'csv_name',
        'file_url',
        'pdf_url',
        'pin_count',
        'balance',
    ];
}
