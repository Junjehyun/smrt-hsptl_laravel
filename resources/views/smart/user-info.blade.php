@extends('layouts.common')
@section('title', 'ユーザー一覧')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mt-5">ユーザー一覧</h1>
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
                        @foreach($users as $user)
                            @if($user->user_type == '000')
                                @continue
                            @endif
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->id }}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->email}}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    {{ $user->department}}
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    @isset($userTypes[$user->user_type])
                                        <span class="{{ $userTypes[$user->user_type]['class'] }}">
                                            {{ $userTypes[$user->user_type]['name'] }}
                                        </span>
                                    @else
                                        <span class="bg-gray-200 text-gray-800 text-sm font-medium mr-2 px-2.5 py-1 rounded-full">
                                        </span>
                                    @endisset
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                        {{-- {{ $user->last_activity_date }} --}}
                                        @if($user->isOnline())
                                            <span class="bg-lime-300 text-gray-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full">ログイン中</span>
                                        @else
                                            <span>最後の接続: {{ $user->last_activity_date }}</span>
                                        @endif
                                </td>
                                <td class="px-5 py-2 border-r whitespace-nowrap">
                                    @if($user->user_type != '777')
                                        <a href="{{ route('revoke-permission', ['id' => $user->id]) }}" onclick="confirmDelete(event, {{ $user->id }})" class="text-rose-400 hover:text-rose-500 font-bold">
                                            <i class="fa-regular fa-trash-can"></i> 権限削除
                                        </a>
                                    @endif
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
    </div>
    <script>
        function confirmDelete(event, userId) {
            event.preventDefault();
            const confirmed = confirm('本当に削除しますか?');
            if (confirmed) {
                alert('権限が削除されまして、承認待機処理しました。')
                window.location.href = event.currentTarget.href;
            }
        }

    </script>
@endsection