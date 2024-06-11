<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $table = 'masters';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'master_key',
        'master_name',
        'item_code',
        'item_name',
        'item_nm_short',
        'item_nm_eng',
        'order',
        'use_flag',
        'remarks',
        ];
}
