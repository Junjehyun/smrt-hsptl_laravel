<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Consts\ModelConsts;
class Medical_info extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        ModelConsts::MEDICAL_INFO_FIELD_CUSTOMER_NO,
        ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT,
        ModelConsts::MEDICAL_INFO_FIELD_DOCTOR_NAME,
        ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT_CODE,
        ModelConsts::MEDICAL_INFO_FIELD_SEVERITY,
        ModelConsts::MEDICAL_INFO_FIELD_FALL,
        ModelConsts::MEDICAL_INFO_FIELD_BLOOD_WARN,
        ModelConsts::MEDICAL_INFO_FIELD_CONTACT_WARN,
        ModelConsts::MEDICAL_INFO_FIELD_AIR_WARN,
        ModelConsts::MEDICAL_INFO_FIELD_CURRENT_FLAG,
        ModelConsts::MEDICAL_INFO_FIELD_REMARKS,
        ModelConsts::MEDICAL_INFO_FIELD_CREATOR_ID,
        ModelConsts::MEDICAL_INFO_FIELD_UPDATER_ID,

    ];

    protected $casts = [

        ModelConsts::MEDICAL_INFO_FIELD_BLOOD_WARN => 'boolean',
        ModelConsts::MEDICAL_INFO_FIELD_CONTACT_WARN => 'boolean',
        ModelConsts::MEDICAL_INFO_FIELD_AIR_WARN => 'boolean',
        ModelConsts::MEDICAL_INFO_FIELD_CURRENT_FLAG => 'boolean',
    ];

    protected static function boot() {
        parent::boot();
        //モデルを生成する時、自動的にdepartment_codeを設定する
        static::creating(function ($medical_info) {
            $medical_info->department_code = $medical_info->generateDepartmentCode();
        });
    }

    public function generateDepartmentCode() 
    {
        do {
            $code = 'DEPT' . Str::random(4);
        } while (self::where(ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT_CODE, $code)->exists());

        return $code;
        
    }
}
