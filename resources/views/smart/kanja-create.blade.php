@extends('layouts.common')

@section('title', '患者登録')

@section('content')

    <h1 class="text-4xl font-bold text-left mb-5">患者登録</h1>
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kanja.store') }}" method="POST">
    @csrf    
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <!-- 個人情報Section -->
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">患者情報</h2>   
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">氏名 <span class="text-red-500">必須</span></label>
                        <input name="name" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="氏名" value="{{ old('name') }}">
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">生年月日 <span class="text-red-500">必須</span></label>
                        <div class="flex space-x-2">
                            <select id="year" name="birth_year" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/3">
                                <option value="">年</option>
                                @for ($i = now()->year; $i >= 1940; $i--)
                                    <option value="{{ $i }}" {{ old('birth_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <select  id="month" name="birth_month" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/4">
                                <option value="">月</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('birth_month') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <select id="day" name="birth_day" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/4">
                                <option value="">日</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ old('birth_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">性別 <span class="text-red-500">必須</span></label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" class="form-radio" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                                <span class="ml-2">男</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" class="form-radio" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                                <span class="ml-2">女</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">入院日付 <span class="text-red-500">必須</span></label>
                        <input type="text" id="hospital_date" name="hospital_date" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('hospital_date') }}">
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">血液型 <span class="text-red-500">必須</span></label>
                        <select name="blood_type" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option>※選択して下さい</option>
                            @foreach($blood_types as $blood_type)
                                <option value="{{ $blood_type }}" {{ old('blood_type') == $blood_type ? 'selected' : '' }}>{{ $blood_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">電話番号 <span class="text-red-500">必須</span></label>
                        <input name="telephone" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="電話番号" value="{{ old('telephone') }}">
                    </div>
                    <div class="flex flex-col col-span-2">
                        <label class="mb-1 text-sm text-gray-600">住所</label>
                        <input name="address" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="住所" value={{ old('address') }}>
                    </div>
                </div>
            </div>
            <!-- 診療情報Section -->
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
                <h3 class="text-2xl font-bold mb-4">診療情報</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">診療科 <span class="text-red-500">必須</span></label>
                        <select name="department" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option>※選択して下さい</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department }}" {{ old('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">担当医名 <span class="text-red-500">必須</span></label>
                        <input name="doctor_name" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="担当医名" value={{ old('doctor_name') }}>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">重症度 <span class="text-red-500">必須</span></label>
                        <select name="severity" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option>※選択して下さい</option>
                            @foreach($severities as $severity)
                                <option value="{{ $severity }}" {{ old('severity') == $severity ? 'selected' : '' }}>{{ $severity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1 text-sm text-gray-600">落傷 <span class="text-red-500">必須</span></label>
                        <select name="fall" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option>※選択して下さい</option>
                            @foreach($falls as $fall)
                                <option value="{{ $fall }}" {{ old('fall') == $fall ? 'selected' : '' }}>{{ $fall }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <label class="mb-1 text-sm text-gray-600">注意事項</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="blood_warn" value="true" {{ old('blood_warn') == 'true' ? 'checked' : '' }}>
                                <span class="ml-2">血液</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="contact_warn" value="true" {{ old('contact_warn') == 'true' ? 'checked' : '' }}>
                                <span class="ml-2">接触主義</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="air_warn" value="true" {{ old('air_warn') == 'true' ? 'checked' : '' }}>
                                <span class="ml-2">空気注意</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <label class="mb-1 text-sm text-gray-600">重要事項</label>
                        <textarea class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="重要事項" name="remarks"}}> {{ old('remarks') }} </textarea>
                    </div>
                </div>
            </div>      
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-sky-400 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">
                登録する
            </button>
        </div>
    </form>    
    <script>
        //カレンダーのOption
        const dateInput = document.getElementById('hospital_date');
                hospital_date.addEventListener('focus', (e) => {
                dateInput.type = 'date';
                
            });
            dateInput.addEventListener('blur', (e) => {
                dateInput.type = 'text';
                dateInput.placeholder = "入院日選択(YYYY-MM-DD)";
        });
    </script>
@endsection