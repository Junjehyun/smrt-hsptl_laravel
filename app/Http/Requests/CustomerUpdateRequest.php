<?php

namespace App\Http\Requests;
use App\Consts\ControllerConsts;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest {
    /**
     * リクエストのバリデーションを行うかどうか設定する
     * 
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * バリデーションルールを決める
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() {
        return [
        // 患者情報
        //ControllerConsts::FIELD_NAME => 'required|string|max:10',
        ControllerConsts::FIELD_BIRTH_YEAR => 'required|integer|digits:4',
        ControllerConsts::FIELD_BIRTH_MONTH => 'required|numeric|between:1,12',
        ControllerConsts::FIELD_BIRTH_DAY => 'required|numeric|between:1,31',
        ControllerConsts::FIELD_GENDER => 'required|string',
        //ControllerConsts::FIELD_HOSPITAL_DATE => 'required|date',
        ControllerConsts::FIELD_BLOOD_TYPE => 'required|string|max:5',
        ControllerConsts::FIELD_TELEPHONE => 'required|string|max:20',
        ControllerConsts::FIELD_ADDRESS => 'nullable|string|max:50',

        // 診療情報
        ControllerConsts::FIELD_DEPARTMENT => 'required|string|not_in:※選択して下さい|max:10',
        ControllerConsts::FIELD_DOCTOR_NAME => 'required|string|max:10',
        ControllerConsts::FIELD_SEVERITY => 'required|string|not_in:※選択して下さい|max:10',
        ControllerConsts::FIELD_FALL => 'required|string|not_in:※選択して下さい|max:10',
        ControllerConsts::FIELD_BLOOD_WARN => 'nullable|in:true,false,1,0',
        ControllerConsts::FIELD_CONTACT_WARN => 'nullable|in:true,false,1,0',
        ControllerConsts::FIELD_AIR_WARN => 'nullable|in:true,false,1,0',
        ControllerConsts::FIELD_REMARKS => 'nullable|string',
        ControllerConsts::FIELD_IMPORTANT_NOTES => 'nullable|string',
        ];
    }

    /**
     * バリデーションエラーメッセージをカスタマイズ
     * 
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            // 患者情報
            ControllerConsts::FIELD_NAME . '.required' => '氏名は必須です。',
            ControllerConsts::FIELD_NAME . '.string' => '氏名は文字列でなければなりません。',
            ControllerConsts::FIELD_NAME . '.max' => '氏名は10文字以内でなければなりません。',
            ControllerConsts::FIELD_BIRTH_YEAR . '.required' => '生年は必須です。',
            ControllerConsts::FIELD_BIRTH_YEAR . '.integer' => '生年は整数でなければなりません。',
            ControllerConsts::FIELD_BIRTH_YEAR . '.digits' => '生年は4桁でなければなりません。',
            ControllerConsts::FIELD_BIRTH_MONTH . '.required' => '誕生月は必須です。',
            ControllerConsts::FIELD_BIRTH_MONTH . '.numeric' => '誕生月は数字でなければなりません。',
            ControllerConsts::FIELD_BIRTH_MONTH . '.between' => '誕生月は1から12の間でなければなりません。',
            ControllerConsts::FIELD_BIRTH_DAY . '.required' => '誕生日は必須です。',
            ControllerConsts::FIELD_BIRTH_DAY . '.numeric' => '誕生日は数字でなければなりません。',
            ControllerConsts::FIELD_BIRTH_DAY . '.between' => '誕生日は1から31の間でなければなりません。',
            ControllerConsts::FIELD_GENDER . '.required' => '性別は必須です。',
            ControllerConsts::FIELD_GENDER . '.string' => '性別は文字列でなければなりません。',
            ControllerConsts::FIELD_HOSPITAL_DATE . '.required' => '入院日は必須です。',
            ControllerConsts::FIELD_HOSPITAL_DATE . '.date' => '入院日は有効な日付でなければなりません。',
            ControllerConsts::FIELD_BLOOD_TYPE . '.required' => '血液型は必須です。',
            ControllerConsts::FIELD_BLOOD_TYPE . '.string' => '血液型は文字列でなければなりません。',
            ControllerConsts::FIELD_BLOOD_TYPE . '.max' => '血液型を選択してください。',
            ControllerConsts::FIELD_BLOOD_TYPE . '.not_in' => '有効な血液型を選択してください。',
            ControllerConsts::FIELD_TELEPHONE . '.required' => '電話番号は必須です。',
            ControllerConsts::FIELD_TELEPHONE . '.string' => '電話番号は文字列でなければなりません。',
            ControllerConsts::FIELD_TELEPHONE . '.max' => '電話番号は20文字以内でなければなりません。',
            ControllerConsts::FIELD_ADDRESS . '.string' => '住所は文字列でなければなりません。',
            ControllerConsts::FIELD_ADDRESS . '.max' => '住所は50文字以内でなければなりません。',
            // 診療情報
            ControllerConsts::FIELD_DEPARTMENT . '.required' => '診療科は必須です。',
            ControllerConsts::FIELD_DEPARTMENT . '.string' => '診療科は文字列でなければなりません。',
            ControllerConsts::FIELD_DEPARTMENT . '.max' => '診療科を選択してください。',
            ControllerConsts::FIELD_DEPARTMENT . '.not_in' => '有効な診療科を選択してください。',
            ControllerConsts::FIELD_DOCTOR_NAME . '.required' => '医師名は必須です。',
            ControllerConsts::FIELD_DOCTOR_NAME . '.string' => '医師名は文字列でなければなりません。',
            ControllerConsts::FIELD_DOCTOR_NAME . '.max' => '医師名は10文字以内でなければなりません。',
            ControllerConsts::FIELD_SEVERITY . '.required' => '重症度は必須です。',
            ControllerConsts::FIELD_SEVERITY . '.string' => '重症度は文字列でなければなりません。',
            ControllerConsts::FIELD_SEVERITY . '.max' => '重症度を選択してください。',
            ControllerConsts::FIELD_SEVERITY . '.not_in' => '有効な重症度を選択してください。',
            ControllerConsts::FIELD_FALL . '.required' => '転倒は必須です。',
            ControllerConsts::FIELD_FALL . '.string' => '転倒は文字列でなければなりません。',
            ControllerConsts::FIELD_FALL . '.max' => '転倒を選択してください。',
            ControllerConsts::FIELD_FALL . '.not_in' => '有効な転倒状態を選択してください。',
            ControllerConsts::FIELD_BLOOD_WARN . '.boolean' => '注意事項をチェックしてください。',
            ControllerConsts::FIELD_CONTACT_WARN . '.boolean' => '注意事項をチェックしてください。',
            ControllerConsts::FIELD_AIR_WARN . '.boolean' => '注意事項をチェックしてください。',
            ControllerConsts::FIELD_REMARKS . '.string' => '備考は文字列でなければなりません。',
            ControllerConsts::FIELD_IMPORTANT_NOTES . '.string' => '重要な注意事項は文字列でなければなりません。',
        ];
    }
}