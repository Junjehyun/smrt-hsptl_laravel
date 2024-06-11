<?php

namespace App\Consts;

/**
 * 各モデルのフィールド名を常数化するクラス
 * 
 */
class ModelConsts {

   // Customerモデルフィルダー常数
   const CUSTOMER_FIELD_CUSTOMER_NO = 'customer_no';
   const CUSTOMER_FIELD_NAME = 'name';
   const CUSTOMER_FIELD_SEX = 'sex';
   const CUSTOMER_FIELD_BIRTHDATE = 'birthdate';
   const CUSTOMER_FIELD_TELEPHONE = 'telephone';
   const CUSTOMER_FIELD_ADDRESS = 'address';
   const CUSTOMER_FIELD_WARD_CODE = 'ward_code';
   const CUSTOMER_FIELD_ROOM_CODE = 'room_code';
   const CUSTOMER_FIELD_BED_NO = 'bed_no';
   const CUSTOMER_FIELD_BLOOD_TYPE = 'blood_type';
   const CUSTOMER_FIELD_SEVERITY = 'severity';
   const CUSTOMER_FIELD_FALL = 'fall';
   const CUSTOMER_FIELD_HOSPITALIZED_DATE = 'hospitalized_date';
   const CUSTOMER_FIELD_REMARKS = 'remarks';
   const CUSTOMER_FIELD_OLD_WARD_CODE = 'old_ward_code';
   const CUSTOMER_FIELD_OLD_ROOM_CODE = 'old_room_code';
   const CUSTOMER_FIELD_OLD_BED_NO = 'old_bed_no';
   const CUSTOMER_FIELD_STATUS = 'status';
   const CUSTOMER_FIELD_DEVICE_SEQ = 'device_seq';
   const CUSTOMER_FIELD_DEVICE_NAME = 'device_name';
   const CUSTOMER_FIELD_CREATOR_ID = 'creator_id';
   const CUSTOMER_FIELD_UPDATER_ID = 'updater_id';
   const CUSTOMER_FIELD_CREATED_AT = 'created_at';
   const CUSTOMER_FIELD_UPDATED_AT = 'updated_at';
   const CUSTOMER_FIELD_DELETED_AT = 'deleted_at';

   // Medical_infoモデルフィルダー常数
   const MEDICAL_INFO_FIELD_CUSTOMER_NO = 'customer_no';
   const MEDICAL_INFO_FIELD_DEPARTMENT = 'department';
   const MEDICAL_INFO_FIELD_DOCTOR_NAME = 'doctor_name';
   const MEDICAL_INFO_FIELD_DEPARTMENT_CODE = 'department_code';
   const MEDICAL_INFO_FIELD_SEVERITY = 'severity';
   const MEDICAL_INFO_FIELD_FALL = 'fall';
   const MEDICAL_INFO_FIELD_BLOOD_WARN = 'blood_warn';
   const MEDICAL_INFO_FIELD_CONTACT_WARN = 'contact_warn';
   const MEDICAL_INFO_FIELD_AIR_WARN = 'air_warn';
   const MEDICAL_INFO_FIELD_CURRENT_FLAG = 'current_flag';
   const MEDICAL_INFO_FIELD_REMARKS = 'remarks';
   const MEDICAL_INFO_FIELD_CREATOR_ID = 'creator_id';
   const MEDICAL_INFO_FIELD_UPDATER_ID = 'updater_id';
   const MEDICAL_INFO_FIELD_CREATED_AT = 'created_at';
   const MEDICAL_INFO_FIELD_UPDATED_AT = 'updated_at';
   const MEDICAL_INFO_FIELD_DELETED_AT = 'deleted_at';

   // Medical_commentモデルフィルダー常数
   const MEDICAL_COMMENT_FIELD_CUSTOMER_NO = 'customer_no';
   const MEDICAL_COMMENT_FIELD_DEPARTMENT_CODE = 'department_code';
   const MEDICAL_COMMENT_FIELD_EMPLOY_ID = 'employ_id';
   const MEDICAL_COMMENT_FIELD_COMMENTS = 'comments';
   const MEDICAL_COMMENT_FIELD_CREATE_DATE = 'create_date';
   const MEDICAL_COMMENT_FIELD_CREATED_AT = 'created_at';
   const MEDICAL_COMMENT_FIELD_UPDATED_AT = 'updated_at';
   const MEDICAL_COMMENT_FIELD_DELETED_AT = 'deleted_at';

}