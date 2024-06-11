@extends('layouts.common')

@section('title', '患者情報修正')

@section('content')
    <h1 class="text-4xl font-bold text-left mb-5">患者情報修正</h1>
    <form action="{{ route('kanja.update', ['customer_no'=>$customer->customer_no]) }}" method="POST">
    @csrf    
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <!-- 個人情報Section -->
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">患者情報</h2>   
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">氏名 <span class="text-red-500">必須</span></label>
                        <input name="name" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-gray-100 cursor-not-allowed" type="text" placeholder="氏名" value="{{ old('name', $customer->name) }}" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">生年月日 <span class="text-red-500">必須</span></label>
                        <div class="flex space-x-2">

                            <select id="year" name="birth_year" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/3">
                                <option value="">年</option>
                                @for ($i = 1940; $i <= now()->year; $i++)
                                    <option value="{{ $i }}" {{ old('birth_year', $birth_year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <select id="month" name="birth_month" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/4">
                                <option value="">月</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('birth_month', $birth_month) == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <select id="day" name="birth_day" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/4">
                                <option value="">日</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('birth_day', $birth_day) == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">性別 <span class="text-red-500">必須</span></label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" class="form-radio" value="1" {{ old('gender', $gender) == '1' ? 'checked' : '' }}>
                                <span class="ml-2">男</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" class="form-radio" value="2" {{ old('gender', $gender) == '2' ? 'checked' : '' }}>
                                <span class="ml-2">女</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">入院日付 <span class="text-red-500">必須</span></label>
                        <input type="text" id="hospital_date" name="hospital_date" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-gray-100 cursor-not-allowed" value="{{ $hospitalized_date }}" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">血液型 <span class="text-red-500">必須</span></label>
                        <select name="blood_type" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option>※選択して下さい</option>
                            @foreach($blood_types as $type)
                                <option value="{{ $type }}" {{ old('blood_type', $blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">電話番号 <span class="text-red-500">必須</span></label>
                        <input name="telephone" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="電話番号" value="{{ old('telephone', $customer->telephone) }}">
                    </div>
                    <div class="flex flex-col col-span-2">
                        <label class="mb-1 text-sm text-gray-600">住所</label>
                        <input name="address" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="住所" value="{{ old('address', $customer->address) }}">
                    </div>
                </div>
            </div>
            <!-- 診療情報Section -->
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
                <h3 class="text-2xl font-bold mb-4">診療情報</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">診療科 <span class="text-red-500">必須</span></label>
                        <select class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" name="department">
                            <option>※選択して下さい</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ old('department', $department) == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">担当医名 <span class="text-red-500">必須</span></label>
                        <input class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="担当医名" name="doctor_name" value="{{ old('doctor_name', $doctor_names) }}">
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">重症度 <span class="text-red-500">必須</span></label>
                        <select class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" name="severity">
                            <option>※選択して下さい</option>
                            @foreach($severities as $severityOption)
                                <option value="{{ $severityOption }}" {{ old('severity', $severity) == $severityOption ? 'selected' : '' }}>{{ $severityOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">落傷 <span class="text-red-500">必須</span></label>
                        <select class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" name="fall">
                            <option>※選択して下さい</option>
                            @foreach($falls as $fallOption)
                                <option value="{{ $fallOption }}" {{ old('fall', $fall) == $fallOption ? 'selected' : '' }}>{{ $fallOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <label class="mb-1 text-sm text-gray-600">注意事項</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="blood_warn" value="1" {{ old('blood_warn', $blood_warn) ? 'checked' : '' }}>
                                <span class="ml-2">血液</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="contact_warn" value="1" {{ old('contact_warn', $contact_warn) ? 'checked' : '' }}>
                                <span class="ml-2">接触主義</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="air_warn" value="1" {{ old('air_warn', $air_warn) ? 'checked' : '' }}>
                                <span class="ml-2">空気注意</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <label class="mb-1 text-sm text-gray-600">重要事項</label>
                        <textarea class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="重要事項" name="remarks">{{ old('remarks', $remarks) }}</textarea>
                    </div>
                </div>
            </div>      
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-sky-400 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">
                修正する
            </button>
        </div>
    </form>    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById('hospital_date');
            let initialValue = dateInput.value;

            //時間を表示しないようにする
            if (initialValue) {
                const dateValue = new Date(initialValue);
                const year = dateValue.getFullYear();
                const month = ("0" + (dateValue.getMonth() + 1)).slice(-2);
                const day = ("0" + dateValue.getDate()).slice(-2);
                dateInput.value = `${year}-${month}-${day}`;
            }

            // 初期値がない場合はプレースホルダーを設定
            if (!initialValue) {
                dateInput.placeholder = "YYYY-MM-DD";
            }

            // フォーカス時に日付選択に変更
            dateInput.addEventListener('focus', function() {
                dateInput.type = 'date';
                dateInput.removeAttribute('placeholder');
                if (initialValue) {
                    dateInput.value = initialValue;
                }
            });

            // フォーカスが外れた時に日付形式に変換
            dateInput.addEventListener('blur', function() {
                if (!dateInput.value) {
                    dateInput.type = 'text';
                    dateInput.placeholder = "YYYY-MM-DD";
                    dateInput.value = initialValue;
                } else {
                    const dateValue = new Date(dateInput.value);
                    const year = dateValue.getFullYear();
                    const month = ("0" + (dateValue.getMonth() + 1)).slice(-2);
                    const day = ("0" + dateValue.getDate()).slice(-2);
                    dateInput.type = 'text';
                    dateInput.value = `${year}-${month}-${day}`;
                    inputValue = dateInput.value;
                }
            });
        });
    </script>
@endsection