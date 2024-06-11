<?php

use Illuminate\Support\Facades\DB;
use App\Consts\CustomerConstants;

trait CustomerQuery {

    /**
     * CustomerQueryをLeftJoinで結合
     */
    public function buildCustomerQueryTrait() 
    {
        return DB::table('customers')
        ->leftJoin('medical_infos', 'customers.customer_no', '=', 'medical_infos.customer_no')
        ->leftJoin('medical_comments', 'customers.customer_no', '=', 'medical_comments.customer_no')
        ->select(
            'customers.name', // 氏名
            'medical_infos.customer_no', // 患者番号
            'customers.sex', // 性別
            'customers.birthdate', // 生年月日
            'medical_infos.department', // 診療科
            'medical_infos.doctor_name', // 医師名
            'customers.room_code', // 病室
            'customers.blood_type', // 血液型
            'medical_infos.severity', // 重症度
            'medical_infos.fall' // 落傷
        );

        // return DB::table(CustomerConstants::CUSTOMERS_TABLE)
        // ->leftJoin(CustomerConstants::MEDICAL_INFOS_TABLE, CustomerConstants::COLUMNS['CUSTOMER_NO'], '=', CustomerConstants::COLUMNS['CUSTOMER_NO'])
        // ->leftJoin(CustomerConstants::MEDICAL_COMMENTS_TABLE, CustomerConstants::COLUMNS['CUSTOMER_NO'], '=', CustomerConstants::COLUMNS['CUSTOMER_NO'])
        // ->select(
        //     CustomerConstants::COLUMNS['CUSTOMERS_NAME'],
        //     CustomerConstants::COLUMNS['CUSTOMER_NO'],
        //     CustomerConstants::COLUMNS['SEX'],
        //     CustomerConstants::COLUMNS['BIRTHDATE'],
        //     CustomerConstants::COLUMNS['DEPARTMENT'],
        //     CustomerConstants::COLUMNS['DOCTOR_NAME'],
        //     CustomerConstants::COLUMNS['ROOM_CODE'],
        //     CustomerConstants::COLUMNS['BLOOD_TYPE'],
        //     CustomerConstants::COLUMNS['SERVERITY'],
        //     CustomerConstants::COLUMNS['FALL']
        // );
    
        
    
    }
}
