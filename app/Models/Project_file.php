<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_file extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'file',
        'mime_type',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
