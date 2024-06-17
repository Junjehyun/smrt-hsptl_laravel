@extends('layouts.common')
@section('title', 'QR Tag登録画面')
@section('content')
    <div class="container">
        <a href="/qr-tag">
            <h1 class="text-4xl font-bold text-left mt-5">スマートタグ一登録</h1>
        </a>
        <div class="flex-grow text-left mt-5">
            <button type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">QReader開始</button>
            <button type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">再開始</button>
            <button type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">STOP</button>
        </div>
        <h2 class="mt-3 font-semibold">
            [QRreader開始]ボタンでReaderが起動します。
        </h2>
    </div>    
    <div class="container flex justify-left max-w-8xl p-5 py-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-1/2">
            <h2 class="font-bold text-gray-800">基本情報</h2>
            <hr class="mb-4 border-sky-200">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">SerialNo <span class="text-red-500">必須</span></label>
                    <input type="text" placeholder="Serial No" class="rounded">
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">MAC アドレス <span class="text-red-500">必須</span></label>
                    <input type="text" placeholder="MAC アドレス" class="rounded">
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">タグのタイプ <span class="text-red-500">必須</span></label>
                    <div class="flex flex-row">
                        <div>
                            <input type="radio">
                            <label for="opt1">病室</label>
                        </div>
                        <div class="ml-3">
                            <input type="radio">
                            <label for="opt2">ベッド</label>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">
                    登録
                </button>
            </div>
        </div>
    </div>
@endsection