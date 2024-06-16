<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            <p class="text-gray-600 font-bold text-center">未承認ユーザーにお知らせ</p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                {{-- <x-welcome /> --}}
                <div class="container mx-auto text-center">
                    <h2 class="text-xl font-semibold mb-4">スーパー管理者の承認が必要です</h2>
                    <p class="text-gray-600 mb-6 font-bold">承認を受け取るまではご利用いただけません。</p>
                    </br>
                    <p class="text-gray-600 mb-2">ログインまたは新規登録を希望する場合はこちら ↓</p>
                    <a href="/login" class="inline-block bg-sky-400 text-white font-bold py-2 px-4 rounded hover:bg-sky-600 transition-colors">
                        ログイン
                    </a>
                    <a href="/register" class="inline-block ml-4 bg-emerald-400 text-white font-bold py-2 px-4 rounded hover:bg-emerald-600 transition-colors">
                        新規登録
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
