<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'facility_name' => 'required|string|max:50',
            'hsptl_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=800,max_height=400',
            'license_count' => 'required|integer|min:1',
            'lang_type' => 'required|string|in:01,02,03'
        ];
    }

    public function messages() {

        return [
            'facility_name.required' => 'イメージ名は必須です。',
            'hsptl_image.required' => 'ファイルを選択してください。',
            'hsptl_image.image' => 'アップロードされたファイルは画像でなければなりません。',
            'hsptl_image.mimes' => '画像の形式はjpeg, png, jpg, gifのいずれかでなければなりません。',
            'hsptl_image.max' => '画像のアップロード可能容量は2MBです。',
            'hsptl_image.dimensions' => '画像のサイズは最大800x400pxです。',
            'license_count.required' => 'ライセンス数が正しくありません。',
            'lang_type.required' => '言語は必須選択です。'
        ];
    }
}
