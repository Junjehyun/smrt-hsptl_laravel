@extends('layouts.common')
@section('title', 'マスター情報一覧')
@section('content')
    <div class="container">
        <h1 class="text-4xl font-bold mt-5">マスターデータ一覧</h1>
        <div class="flex justify-center max-w-4xl mx-auto p-5 py-8 mt-8">
            <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
                <label for="master" class="block text-lg font-medium text-blue-400">
                    ※マスターデータ選択で内容が確認できます。
                </label>
                <div class="mt-8">
                    <select id="master" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @foreach($masters as $index => $master)
                            <option value="{{ $master->master_name }}" {{ $index === 0 ? 'selected' : '' }}>{{ $master->master_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="values" class="mt-8">
                    <table id="values-table" class="min-w-full leading-normal rounded-lg shadow">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-300">
                                <th class="px-5 py-3 bg-sky-50 text-left text-sm font-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">NO</th>
                                <th class="px-5 py-3 bg-sky-50 text-left text-sm font-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">コード名</th>
                                <th class="px-5 py-3 bg-sky-50 text-left text-sm font-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">表示名</th>
                            </tr>
                        </thead>
                        <tbody id="valuesBody">
                            <!-- 出力物が追加される。 作業はAJAXでしました。-->
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const masterSelect = $('#master');
            const valuesBody = $('#valuesBody');

            function masterData(masterName) {
                $.ajax({
                    url: '/master/values',
                    type: 'POST',
                    data: JSON.stringify({ master_name: masterName }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        const valuesBody = $('#valuesBody');
                        valuesBody.empty();
                        data.forEach(function(item, index) {
                            const tr = $('<tr>').addClass('hover:bg-gray-50 border-b');
                            tr.append($('<td>').addClass('px-5 py-2 border-r whitespace-nowrap').text(index + 1));
                            tr.append($('<td>').addClass('px-5 py-2 border-r whitespace-nowrap').text(item.item_code));
                            // 項目によってitem_nameまたはitem_nm_shortを出力
                            const itemName = (masterName === '重症度' || masterName === '落傷') ? item.item_nm_short : item.item_name;
                            tr.append($('<td>').addClass('px-5 py-2 border-r whitespace-nowrap').text(itemName));
                            valuesBody.append(tr);
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
            // ページロード時にデフォルトデータを取得する
            masterData(masterSelect.val());
            //セレクトボックスの値が変更されたらデータを取得する
            masterSelect.on('change', function() {
                masterData($(this).val());
            });
        });
    </script>
@endsection