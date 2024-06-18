@extends('layouts.common')
@section('title', 'QR Tag登録画面')
@section('content')
    <div class="container p-6 py-8">
        <a href="/qr-tag">
            <h1 class="text-4xl font-bold text-left mt-5">スマートタグ一登録</h1>
        </a>
        <div class="flex-grow text-left mt-5">
            <button id="startReaderBtn" type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">QReader開始</button>
            <button id="restartReaderBtn" type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">再開始</button>
            <button id="stopReaderBtn" type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">STOP</button>
        </div>
        <h2 class="mt-3 font-semibold">
            [QRreader開始]ボタンでReaderが起動します。
        </h2>
    </div>    
    <div id="qr-reader" style="width:500px; transform: scaleX(-1);"></div>  
    <div id="qr-reader-results"></div>  
    <button id="fillDetailsBtn" type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">
        反映
    </button>
    <form action="{{ route('save-qr-code') }}" method="POST">
    @csrf
        <div class="container flex justify-left max-w-8xl p-5 py-8">
            <div class="bg-white p-6 rounded-lg shadow space-y-3 w-1/2">
                <h2 class="font-bold text-xl text-gray-800">基本情報</h2>
                <hr class="mb-4 border-sky-200">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-m text-gray-600">SerialNo <span class="text-red-500">必須</span></label>
                        <input id="serialNoInput" name="tag_id" type="text" placeholder="Serial No" class="rounded">
                    </div>
                </div>
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-m text-gray-600">MAC アドレス <span class="text-red-500">必須</span></label>
                        <input id="macAddressInput" name="mac_address" type="text" placeholder="MAC アドレス" class="rounded">
                    </div>
                </div>
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1 text-m text-gray-600">タグのタイプ <span class="text-red-500">必須</span></label>
                        <div class="flex flex-row">
                            <div>
                                <input id="roomType" name="tag_type" type="radio" value="1">
                                <label for="opt1">病室</label>
                            </div>
                            <div class="ml-3">
                                <input id="bedType" name="tag_type" type="radio" value="2">
                                <label for="opt2">ベッド</label>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-10">
                        登録
                    </button>
                </div>
            </div>
        </div>
    </form>
    {{-- QR Reader CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
            const startReaderBtn = document.getElementById('startReaderBtn');
            const restartReaderBtn = document.getElementById('restartReaderBtn');
            const stopReaderBtn = document.getElementById('stopReaderBtn');
            const qrCodeReader = new Html5Qrcode("qr-reader");
            const qrReaderElement = document.getElementById('qr-reader');
            let qrCodeData = '';
            //反映ボタン
            const fillDetailsBtn = document.getElementById('fillDetailsBtn');
            fillDetailsBtn.style.display = 'none';

            startReaderBtn.addEventListener('click', () => {
                qrReaderElement.style.display = 'block';
                startReaderBtn.style.display = 'none';
                fillDetailsBtn.style.display = 'block';
                //撮影スタート
                qrCodeReader.start(
                    { facingMode: 'environment' },
                    { fps: 10, qrbox: 250 },
                    (decodedText, decodedResult) => {
                        document.getElementById('qr-reader-results').innerHTML = `QRコードの情報: <span style="color: red;">${decodedText}</span>`;
                        console.log(`QRコードの取得に成功しました: ${decodedText}`);
                        qrCodeData = decodedText;
                    },
                    (errorMessage) => {
                    }
                ).catch((err) => {
                    console.log(`スキャニングができません。 エラーメッセージ: ${err}`);
                });
            });

            stopReaderBtn.addEventListener('click', () => {
                qrCodeReader.stop().then((ignore) => {
                    console.log("QRコードスキャニングが停止しました。");
                    qrReaderElement.style.display = 'none';
                    fillDetailsBtn.style.display = 'none';
                }).catch((err) => {
                    console.log(`QRコードスキャニングが停止できません。 エラーメッセージ: ${err}`);
                });
            });

            restartReaderBtn.addEventListener('click', () => {
                qrReaderElement.style.display = 'block';
                fillDetailsBtn.style.display = 'block';
                qrCodeReader.start(
                    { facingMode: 'environment' },
                    { fps: 10, qrbox: 250 },
                    ( decodedText, decodedResult ) => {
                        document.getElementById('qr-code-results').innerHTML = `QR Code detected: ${decodedText}`;
                        console.log(`QRコードの取得に成功しました: ${decodedText}`);
                    },
                    (errorMessage) => {
                    }
                ).catch((err) => {
                    console.log('スキャニングができません。 エラーメッセージ: ${err}');
                });
            });
        
            fillDetailsBtn.addEventListener('click', () =>{
                if(qrCodeData) {
                    const url = new URL(qrCodeData);
                    const params= new URLSearchParams(url.search);

                    document.getElementById('serialNoInput').value = params.get('serial_no') || '';
                    document.getElementById('macAddressInput').value = params.get('mac_address') || '';
                    const tagType = params.get('tag_type');
                    if (tagType === '01') {
                        document.getElementById('roomType').checked = true;
                    } else if (tagType === '02') {
                        document.getElementById('bedType').checked = true;
                    }
                } else {
                    alert('QRコードがまだスキャンされていません。');
                }
            });
    </script>
@endsection