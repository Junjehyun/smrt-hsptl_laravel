<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'onwer_name',
        'description',
        'logo_image_name',
        'logo_short_image_name',
        'background_image_name',
        'banner_display_flag',
        'layout_no',
        'room_layout_no',
        'bed_layout_no',
        'status',
        'license_count',
        'lang_type',
        'creator_id',
        'updater_id',
    ];
}
