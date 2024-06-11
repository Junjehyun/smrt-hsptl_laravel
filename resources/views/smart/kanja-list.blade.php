@php
use App\Consts\ModelConsts;
@endphp


@extends('layouts.common')

@section('title', '患者検索')

@section('content')
    <a href="/kanja-list">
        <h1 class="text-4xl font-bold text-left mt-5">患者検索</h1>
    </a>
    <div class="container flex justify-center max-w-8xl p-5 py-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="overflow-x-auto mt-6 mx-5">
                    <form action="{{ route('kanja-search') }}" method="POST">
                        @csrf
                        <div class="flex items-center mb-5 space-x-3">
                            <input name="kanja-search" class="rounded placeholder-gray-300 h-10 p-2" type="text" placeholder="氏名または患者番号を検索">
                            <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">検索</button>
                            <div class="flex-grow text-right">
                                <a href="/kanja-create">
                                <button type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">患者登録</button>
                                </a>
                            </div>
                        </div>
                    </form>    
                    <div class="w-full">
                        <table id="customer-table" data-order="desc" class="min-w-full leading-normal rounded-lg shadow">    
                            <thead>
                                <tr class="bg-gray-100 border-b-2 border-gray-300">
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                    <input type="checkbox">
                                    <th id="{{ ModelConsts::CUSTOMER_FIELD_NAME }}" class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        <button type="button" onclick="sortTable('{{ ModelConsts::CUSTOMER_FIELD_NAME }}')">
                                            氏名&nbsp;
                                            <i id="nameSortIcon" class="fa-solid fa-angles-{{ request('sortField') == ModelConsts::CUSTOMER_FIELD_NAME && request('sortOrder') == 'asc' ? 'up' : 'down' }}"></i>
                                        </button>
                                    </th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        患者番号</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        性別</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        生年月日</th>
                                    <th id="{{ ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT }}" class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        <button type="button" onclick="sortTable('{{ ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT }}')">
                                            診療科&nbsp;
                                            <i id="departmentSortIcon" class="fa-solid fa-angles-{{ request('sortField') == ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT && request('sortOrder') == 'asc' ? 'up' : 'down' }}"></i>
                                        </button>
                                    </th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        医者名</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        病室</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        血液型</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        重症度</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        落傷</th>
                                    <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                        処理</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="px-5 py-2 border-r"><input type="checkbox"></td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">
                                        <a class="text-sky-500 underline" href="{{ route('kanja.show', ['customer_no' => $customer->customer_no]) }}">
                                            {{ $customer->name }}
                                        </a>
                                    </td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->customer_no }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->sex }}</td> 
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->birthdate }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->department }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->doctor_name }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->room_code }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->blood_type }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->severity }}</td>
                                    <td class="px-5 py-2 border-r whitespace-nowrap">{{ $customer->fall }}</td>
                                    <td class="px-5 py-2">
                                        <!--修正ボタン-->
                                        <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline min-w-20"
                                        onclick="editCustomer('{{ $customer->customer_no }}')">
                                            修正
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center">
                        {{ $customers->appends(['sortField' => request('sortField'), 'sortOrder' => request('sortOrder')])->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function editCustomer(customer_no) {
        const url = `{{ url('kanja-edit') }}/${customer_no}`;
        window.location.href = url;
    }
    
    var columns = {
        '{{ ModelConsts::CUSTOMER_FIELD_NAME }}': { order: 'desc' },
        '{{ ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT }}': { order: 'desc' },
    };
    var urlParams = new URLSearchParams(window.location.search);
    var currentSortField = urlParams.get('sortField');
    var currentSortOrder = urlParams.get('sortOrder');
    var currentPage = urlParams.get('page') || 1;  // 現在のページ番号、でファイルは1

    if (currentSortField && currentSortOrder) {
        columns[currentSortField].order = currentSortOrder;
    }

    function sortTable(columnId) {
        var currentOrder = columns[columnId].order;
        var newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
        window.location.href = `{{ route('kanja.sort') }}?sortField=${columnId}&sortOrder=${newOrder}&page=${currentPage}`;
    }

    function goToPage(page) {
        var sortField = currentSortField || '{{ ModelConsts::CUSTOMER_FIELD_NAME }}';
        var sortOrder = currentSortOrder || 'desc';
        window.location.href = `{{ route('kanja.sort') }}?sortField=${sortField}&sortOrder=${sortOrder}&page=${page}`;
    }

    </script>
@endsection