<?php

namespace App\Traits;

use App\Consts\ControllerConsts;
use App\Consts\ModelConsts;
use App\Models\Customer;
use App\Models\Master;
use App\Models\Medical_comment;
use App\Models\Medical_info;
use Illuminate\Support\Facades\DB;
use Exception;

trait CustomerTrait {

    /**
     * LeftJoinを使って、customersテーブルとmedical_infos,medical_commentテーブルを結合する
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function buildCustomerQuery() {

        return DB::table('customers')

        ->leftJoin(
            'medical_infos',
            'customers.' . ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO,
            '=',
            'medical_infos.' . ModelConsts::MEDICAL_INFO_FIELD_CUSTOMER_NO
        )
        ->select(
            'customers.' . ModelConsts::CUSTOMER_FIELD_NAME,
            'medical_infos.' . ModelConsts::MEDICAL_INFO_FIELD_CUSTOMER_NO,
            'customers.' . ModelConsts::CUSTOMER_FIELD_SEX,
            'customers.' . ModelConsts::CUSTOMER_FIELD_BIRTHDATE,
            'medical_infos.' . ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT,
            'medical_infos.' . ModelConsts::MEDICAL_INFO_FIELD_DOCTOR_NAME,
            'customers.' . ModelConsts::CUSTOMER_FIELD_ROOM_CODE,
            'customers.' . ModelConsts::CUSTOMER_FIELD_BLOOD_TYPE,
            'medical_infos.' . ModelConsts::MEDICAL_INFO_FIELD_SEVERITY,
            'medical_infos.' . ModelConsts::MEDICAL_INFO_FIELD_FALL,
            'customers.' . ModelConsts::CUSTOMER_FIELD_CREATED_AT
        );
    }

    /**
     * 性別を変換する
     * 
     * @param string $gender
     * @return string
     */
    public function convertGender($gender) {

        return $gender === '1' ? ControllerConsts::GENDER_MALE : ControllerConsts::GENDER_FEMALE;
    }

    /**
     * 病室番号を生成する
     * 
     * @return string
     * @throws Exception
     */
    public function generateRoomCode()
    {
        $wardCodes = range('A', 'Z');
        $lastRoom = Customer::orderBy(ModelConsts::CUSTOMER_FIELD_ROOM_CODE, 'desc')->first();

        if ($lastRoom) {
            $lastWardCode = substr($lastRoom->room_code, 0, 1);
            $lastRoomNumber = intval(substr($lastRoom->room_code, 1));

            if ($lastWardCode === 'Z' && $lastRoomNumber >= 999) {
                throw new Exception('病室が満室です。');
            }

            if ($lastRoomNumber >= 999) {
                $newWardCodeIndex = array_search($lastWardCode, $wardCodes) + 1;
                $newWardCode = $wardCodes[$newWardCodeIndex];
                $newRoomNumber = 1;
            } else {
                $newWardCode = $lastWardCode;
                $newRoomNumber = $lastRoomNumber + 1;
            }

        } else {
            $newWardCode = 'A';
            $newRoomNumber = 1;
        }

        return $newWardCode . str_pad($newRoomNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * マスターデータを取得する
     * 
     * @return array
     * @throws Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * 
     */
    public function getMasterData()
    {
        $genders = Master::where('master_key', ControllerConsts::MASTER_KEY_GENDER)->where('item_code', '!=', '000')->pluck('item_name');
        $departments = Master::where('master_key', ControllerConsts::MASTER_KEY_DEPARTMENT)->where('item_code', '!=', '000')->pluck('item_name');
        $severities = Master::where('master_key', ControllerConsts::MASTER_KEY_SEVERITY)->where('item_code', '!=', '000')->pluck('item_nm_short');
        $falls = Master::where('master_key', ControllerConsts::MASTER_KEY_FALL)->where('item_code', '!=', '000')->pluck('item_nm_short');
        $blood_types = Master::where('master_key', ControllerConsts::MASTER_KEY_BLOOD_TYPE)->where('item_code', '!=', '000')->pluck('item_name');

        return compact('genders', 'departments', 'severities', 'falls', 'blood_types');
    }

    /**
     * 患者の情報を取得する
     * 
     * @param string $customer_no
     * @return array
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findCustomerDetails($customer_no)
    {
        $customer = Customer::where(ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO, $customer_no)->firstOrFail();
        $medical_comment = Medical_comment::where(ModelConsts::MEDICAL_COMMENT_FIELD_CUSTOMER_NO, $customer_no)->firstOrFail();
        $medical_info = Medical_info::where(ModelConsts::MEDICAL_INFO_FIELD_CUSTOMER_NO, $customer_no)->firstOrFail();

        if (!$customer || !$medical_comment || !$medical_info) {
            abort(404);
        }

        $birthdate = $customer->{ModelConsts::CUSTOMER_FIELD_BIRTHDATE} ?? '0000-00-00'; 
        $birth_year = substr($birthdate, 0, 4);
        $birth_month = substr($birthdate, 4, 2);
        $birth_day = substr($birthdate, 6, 2);
        $gender = $customer->{ModelConsts::CUSTOMER_FIELD_SEX} == '男' ? '1' : '2'; 
        $hospitalized_date = $customer->{ModelConsts::CUSTOMER_FIELD_HOSPITALIZED_DATE} ? date(ControllerConsts::DATE_FORMAT, strtotime($customer->{ModelConsts::CUSTOMER_FIELD_HOSPITALIZED_DATE})) : ''; 

        $blood_type = $customer->{ModelConsts::CUSTOMER_FIELD_BLOOD_TYPE}; 
        $department = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT}; 
        $doctor_names = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_DOCTOR_NAME}; 
        $severity = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_SEVERITY}; 
        $fall = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_FALL}; 
        $comment = $medical_comment->{ModelConsts::MEDICAL_COMMENT_FIELD_COMMENTS}; 
        $air_warn = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_AIR_WARN}; 
        $blood_warn = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_BLOOD_WARN}; 
        $contact_warn = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_CONTACT_WARN}; 
        $remarks = $medical_info->{ModelConsts::MEDICAL_INFO_FIELD_REMARKS};

        return compact(
            'customer', 'medical_comment', 'medical_info', 'birth_year', 'birth_month', 'birth_day', 'gender', 
            'hospitalized_date', 'blood_type', 'department', 'doctor_names', 'severity', 'fall', 'comment', 
            'air_warn', 'blood_warn', 'contact_warn', 'remarks'
        );
    }

}