<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Consts\ModelConsts;

class Medical_comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        ModelConsts::MEDICAL_COMMENT_FIELD_CUSTOMER_NO,
        ModelConsts::MEDICAL_COMMENT_FIELD_DEPARTMENT_CODE,
        ModelConsts::MEDICAL_COMMENT_FIELD_EMPLOY_ID,
        ModelConsts::MEDICAL_COMMENT_FIELD_COMMENTS,
        ModelConsts::MEDICAL_COMMENT_FIELD_CREATE_DATE,
    ];

    protected $dates = [

        ModelConsts::MEDICAL_COMMENT_FIELD_CREATE_DATE,
        ModelConsts::MEDICAL_COMMENT_FIELD_CREATED_AT,
        ModelConsts::MEDICAL_COMMENT_FIELD_UPDATED_AT,
        ModelConsts::MEDICAL_COMMENT_FIELD_DELETED_AT,
    ];

    

    public function customer() {
        
        return $this->belongsTo(Customer::class, ModelConsts::MEDICAL_COMMENT_FIELD_CUSTOMER_NO, ModelConsts::MEDICAL_COMMENT_FIELD_CUSTOMER_NO);

    }

}
