@extends('layouts.common')

@section('title', '患者詳細情報')
@section('content')
    <h1 class="text-4xl font-bold text-left mb-5">患者詳細情報</h1>
    <div class="flex justify-between">
        <!--患者情報-->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-1/2 mr-2">
            <h2 class="text-2xl font-bold mb-4">患者情報</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">氏名</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><span class="text-sky-400">{{ $customer->name }}</span></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">生年月日</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $customer->birthdate }}</td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">性別</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $customer->sex }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">血液型</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $customer->blood_type }}</td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">入院日</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $customer->hospitalized_date }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">電話番号</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $customer->telephone }}</td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">住所</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $customer->address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--診療情報-->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-1/2 mr-2">
            <h2 class="text-2xl font-bold mb-4">診療情報</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">診療科</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><span class="text-sky-400">{{ $medical_info->department ?? '' }}</span></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">担当医名</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $medical_info->doctor_name ?? '' }}</td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">重症度</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $medical_info->severity ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">落傷</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ $medical_info->fall ?? '' }}</td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-bold border">注意事項</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><span class="text-red-400">{{ $medical_info->remarks ?? '' }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--重要事項-->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold md-4 text-sky-400">重要事項</h2>
        <p></p>
    </div>
    <!--コメント-->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold mb-4 text-sky-400">コメント</h2>
        <form action="{{ route('kanja.comment', ['customer_no' => $customer->customer_no]) }}" method="POST">            
        @csrf
            <textarea name="comments" rows="4" class="w-full p-2 border rounded-lg mb-4" placeholder="コメントを入力してください"></textarea>
            <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">コメント登録</button>
        </form>

        <div class="mt-6">
            @foreach($comments as $comment)
                <div class="border-b border-gray-200 mb-4 pb-2">
                    <p><strong>{{ $comment->employ_id }}</strong> <span class="text-gray-600 text-sm">{{ $comment->created_at->diffForHumans() }}</span></p>
                    <p>{{ $comment->comments }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection