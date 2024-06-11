<?php

namespace App\Consts;
/**
 * コントローラーの常數クラス
 * 
 * @package App\Consts
 * @access public
 */
class ControllerConsts {
    //ページネーション
    const PAGINATION_COUNT = 10;

    //日付フォーマット
    const DATE_FORMAT = 'Y-m-d H:i:s';

    //性別
    const GENDER_MALE = '男';
    const GENDER_FEMALE = '女';

    //マスターキー
    const MASTER_KEY_GENDER = '001';
    const MASTER_KEY_DEPARTMENT = '007';
    const MASTER_KEY_SEVERITY = '008';
    const MASTER_KEY_FALL = '009';
    const MASTER_KEY_BLOOD_TYPE = '003';

    // Customer_no(患者番号)の接頭辞
    const CUSTOMER_PREFIX = 'K';

    //フォームField
    const FIELD_NAME = 'name';
    const FIELD_BIRTH_YEAR = 'birth_year';
    const FIELD_BIRTH_MONTH = 'birth_month';
    const FIELD_BIRTH_DAY = 'birth_day';
    const FIELD_GENDER = 'gender';
    const FIELD_HOSPITAL_DATE = 'hospital_date';
    const FIELD_BLOOD_TYPE = 'blood_type';
    const FIELD_TELEPHONE = 'telephone';
    const FIELD_ADDRESS = 'address';
    const FIELD_DEPARTMENT = 'department';
    const FIELD_DOCTOR_NAME = 'doctor_name';
    const FIELD_SEVERITY = 'severity';
    const FIELD_FALL = 'fall';
    const FIELD_BLOOD_WARN = 'blood_warn';
    const FIELD_CONTACT_WARN = 'contact_warn';
    const FIELD_AIR_WARN = 'air_warn';
    const FIELD_REMARKS = 'remarks';
    const FIELD_IMPORTANT_NOTES = 'important_notes';
}