<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            //患者情報
            'name' => 'required|string|max:32',
            'birth_year' => 'required|integer|min:1940|max:' . date('Y'),
            'birth_month' => 'required|integer|min:1|max:12',
            'birth_day' => 'required|integer|min:1|max:31',
            'gender' => 'required|in:1,2',
            'hospitalized_date' => 'required|date',
            'telephone' => 'required|string|max:32',
            'address' => 'nullable|string|max:200',
            //診療情報
            'department' => 'required|string|max:32',
            'doctor_name' => 'required|string|max:32',
            'severity' => 'required|string|max:8',
            'fall' => 'required|string|max:8',
            'blood_warn' => 'required|boolean',
            'contact_warn' => 'required|boolean',
            'air_warn' => 'required|boolean',
            'important_notes' => 'nullable|string|max:200',
        ];
    }
    public function messages() {
     
        return [
            'name.required' => '名前は必須です',
            'birth_year.required' => '生年月日の年は必須です',
            'birth_month.required' => '生年月日の月は必須です',
            'birth_day.required' => '生年月日の日は必須です',
            'gender.required' => '性別は必須です',
            'hospitalized_date.required' => '入院日は必須です',
            'telephone.required' => '電話番号は必須です',

            'department.required' => '診療科は必須です',
            'doctor_name.required' => '医師名は必須です',
            'severity.required' => '重症度は必須です',
            'fall.required' => '転倒リスクは必須です',
        ];
    }
}
