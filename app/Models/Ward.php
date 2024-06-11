<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'id',
        'ward_type',
        'ward_code',
        'ward_name',
        'ward_description',
        'coordinator_code',
        'bgcolor',
        'image_name',
        'remarks',
    ];

    protected $dates = ['deleted_at'];
}
