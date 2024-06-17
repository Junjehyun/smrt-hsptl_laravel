<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmartTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tag_id', 'mac_address', 'tag_location', 'tag_location_nm', 'tag_type',
        'gateway_ip', 'job_type', 'job_result', 'battery_charge_rate', 'temperature',
        'receive_power', 'version', 'use_flag', 'old_tag_location', 'old_tag_location_nm',
        'latest_update', 'creator_id', 'updater_id'
    ];

    protected $dates = ['deleted_at'];
}
