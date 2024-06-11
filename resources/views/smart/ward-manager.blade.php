@extends('layouts.common')
@section('title', '病棟マネージャー管理画面')
@section('content')

    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mt-5">病棟管理者一覧</h1>
        <div class="flex justify-center mt-8">
            <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
                <table class="min-w-full leading-normal rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-300">
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                No
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                氏名
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                Eメール
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                部署
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                ユーザー区分
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                ステータス
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                処理</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="flex justify-center">
                    
                </div>
            </div>
        </div>
    </div>
@endsection