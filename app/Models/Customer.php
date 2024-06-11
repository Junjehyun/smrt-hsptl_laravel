<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Consts\ModelConsts;
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO,
        ModelConsts::CUSTOMER_FIELD_NAME,
        ModelConsts::CUSTOMER_FIELD_SEX,
        ModelConsts::CUSTOMER_FIELD_BIRTHDATE,
        ModelConsts::CUSTOMER_FIELD_TELEPHONE,
        ModelConsts::CUSTOMER_FIELD_ADDRESS,
        ModelConsts::CUSTOMER_FIELD_WARD_CODE,
        ModelConsts::CUSTOMER_FIELD_ROOM_CODE,
        ModelConsts::CUSTOMER_FIELD_BED_NO,
        ModelConsts::CUSTOMER_FIELD_BLOOD_TYPE,
        ModelConsts::CUSTOMER_FIELD_SEVERITY,
        ModelConsts::CUSTOMER_FIELD_FALL,
        ModelConsts::CUSTOMER_FIELD_HOSPITALIZED_DATE,
        ModelConsts::CUSTOMER_FIELD_REMARKS,
        ModelConsts::CUSTOMER_FIELD_OLD_WARD_CODE,
        ModelConsts::CUSTOMER_FIELD_OLD_ROOM_CODE,
        ModelConsts::CUSTOMER_FIELD_OLD_BED_NO,
        ModelConsts::CUSTOMER_FIELD_STATUS,
        ModelConsts::CUSTOMER_FIELD_DEVICE_SEQ,
        ModelConsts::CUSTOMER_FIELD_DEVICE_NAME,
        ModelConsts::CUSTOMER_FIELD_CREATOR_ID,
        ModelConsts::CUSTOMER_FIELD_UPDATER_ID,
    ];

        protected $dates= [

            ModelConsts::CUSTOMER_FIELD_HOSPITALIZED_DATE,
            ModelConsts::CUSTOMER_FIELD_CREATED_AT,
            ModelConsts::CUSTOMER_FIELD_UPDATED_AT,
            ModelConsts::CUSTOMER_FIELD_DELETED_AT,
        
        ];

        public function comments() {

            return $this->hasMany(Medical_comment::class, ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO, ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO);
        }

}

    
