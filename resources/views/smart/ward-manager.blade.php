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
                                病棟
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                                処理</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->id}}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->email}}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->department }}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    @foreach($user->wardManager as $ward)
                                        {{ $ward->ward_code }}<br>
                                    @endforeach
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    <button class="bg-transparent hover:bg-sky-300 text-sky-600 font-semibold hover:text-white py-2 px-4 border border-sky-500 hover:border-transparent rounded wardControlBtn" data-id="{{ $user->id }}">
                                        病棟管理
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center">
                    {{ $users->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
        <div id="updateWardModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50" style="display:none;">
            <div class="ward-modal bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
                <span class="close cursor-pointer text-gray-600 absolute top-4 right-4 text-2xl">&times;</span>
                <h2 class="text-2xl mb-4 text-center font-semibold">管理病棟修正</h2>
                <form id="updateWardForm" class="space-y-4">
                @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <hr class="mt-2 border-sky-100">
                        <div id="userNameDisplay" class="text-lg text-gray-700 font-medium text-center">
                        </div>
                    <hr class="mt-2 border-sky-100">
                    <div class="form-group mt-4 px-2 py-4 rounded-lg border-2 border-sky-100">
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="oneThousand" name="ward_code[]" value="1000" class="mr-2" {{ in_array('1000', old('ward_code', [])) ? 'checked' : '' }}>
                                <label for="ward1">1000病棟</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="twoThousand" name="ward_code[]" value="2000" class="mr-2">
                                <label for="ward2">2000病棟</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="threeThousand" name="ward_code[]" value="3000" class="mr-2">
                                <label for="ward3">3000病棟</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="fourThousand" name="ward_code[]" value="4000" class="mr-2">
                                <label for="ward4">4000病棟</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="fiveThousand" name="ward_code[]" value="5000" class="mr-2">
                                <label for="ward5">5000病棟</label><br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center border-2 border-sky-100 rounded p-2 mt-4">
                        <input id="updateWard" type="checkbox" name="updateWard" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" autocompleted>
                        <label for="updateWard" class="ml-2 text-sm text-gray-900">
                            病棟変更を確認しました。
                        </label>
                    </div>
                    <div class="flex items-center justify-end space-x-2 mt-4">
                        <button type="button" id="updateCancelBtn" class="inline-block rounded bg-gray-100 px-6 py-2 text-xs font-medium uppercase leading-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:ring-0 active:bg-gray-300" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light" style>
                            キャンセル
                        </button>
                        <button id="updateWardBtn" name="updateWardBtn" type="submit" class="ml-1 inline-block rounded bg-sky-400 px-6 py-2 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-sky-600 focus:bg-sky-600 focus:outline-none focus:ring-0 active:bg-sky-700 disabled:bg-gray-300 disabled:cursor-not-allowed disabled:hover:bg-gray-300" disabled>
                            変更
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updateWardModal = document.getElementById('updateWardModal');
            const wardControlButtons = document.querySelectorAll('.wardControlBtn');
            const updateCancelBtn = document.getElementById('updateCancelBtn');
            const closeModalBtn = document.querySelector('.close');
            const updateWardForm = document.getElementById('updateWardForm');
            
            wardControlButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');
                    
                    document.getElementById('user_id').value = userId;
                    document.getElementById('userNameDisplay').textContent = userName;

                $.ajax({
                    url: `/ward-manager/${userId}`,
                    type: 'GET',
                    success: function (data) {
                        const wardCodes = data.ward_codes; 
                        document.querySelectorAll('input[name="ward_code[]"]').forEach(checkbox => {
                            checkbox.checked = wardCodes.includes(checkbox.value);
                        });
                    }
                });
                    
                    updateWardModal.style.display = 'flex';
                });
            });
            closeModalBtn.addEventListener('click', function () {
                updateWardModal.style.display = 'none';
            });
            updateCancelBtn.addEventListener('click', function () {
                updateWardModal.style.display = 'none';
            });
            updateWardForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const userId = document.getElementById('user_id').value;
                const wardCodes = Array.from(document.querySelectorAll('input[name="ward_code[]"]:checked')).map(cb => cb.value);
                $.ajax({
                    url: `/ward-update/${userId}`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ward_codes: wardCodes
                    },
                    success: function (data) {
                        if (data.success) {
                            alert('病棟が正常に更新されました。');
                            location.reload();
                        } else {
                            alert('更新できませんでした。: ' + data.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('更新できませんでした。: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
        
        document.getElementById('updateWard').addEventListener('change', function() {
            document.getElementById('updateWardBtn').disabled = !this.checked;
        });

    </script>
@endsection