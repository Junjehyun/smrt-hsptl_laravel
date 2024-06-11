@extends('layouts.common')

@section('title', '基本情報設定')
@section('content')
<body>
    <form action="{{ route('image-toroku') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 class="text-4xl font-bold text-left mt-5">基本情報設定</h1>
        <div class="container flex justify-center max-w-8xl p-5 py-8">
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">施設名 <span class="text-red-500 text-sm">必須</span></label>
                    <input type="text" name="facility_name" id="facility_name" class="mt-1 p-2 w-full border border-gray-300 rounded" placeholder="施設名を入力して下さい" value="{{ old('facility_name', $facility->name ?? '') }}">
                </div>
                <div class="flex flex-col mt-5">
                    <label class="mb-1 text-m text-gray-600">ロゴファイル <span class="text-red-500 text-sm">必須</span></label>
                    <input name="hsptl_image" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-sky-50 file:text-sky-700
                    hover:file:bg-sky-100 border border-gray-300 rounded" aria-describedby="file_input_help" id="hsptl_image" type="file">
                    <p class="text-sm text-gray-500 mt-2" id="file_input_help">PNG, JPG, or GIF (MAX, 800x400px).</p>
                </div>
                <div class="flex flex-col sm:flex-row items-center mt-5">
                    <div class="w-full sm:w-2/3 lg:w-1/2 sm-flex mt-5" id="logoImageContainer">
                        @if ($logoPath)
                            <img src="{{ asset('images/' . session('image')) }}" alt="Logo" class="w-full h-auto max-h-40 object-contain" id="logoImage">
                        @else
                            <span class="ml-3 text-sm" id="defaultText">画像を選択してください</span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="button" id="imgDelBtn" class="bg-red-400 hover:bg-red-500 font-bold text-center text-white p-2 my-2 sm:my-0 sm:mx-2 rounded w-14 sm:w-16 h-10 sm:h-12 shrink-0"">削除</button>
                    </div>
                </div>
                <div class="sm:grid grid-cols-2 gap-4 mt-5">
                    <div class="flex flex-col mb-4">
                        <label class="mb-1 text-lg text-gray-600">ライセンス数 <span class="text-red-500 text-sm">必須</span></label>
                        <input type="text" name="license_count" id="license_count" value="{{ ($facility->license_count ?? 100) }}" class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-1 text-lg text-gray-600">言語 <span class="text-red-500 text-sm">必須</span></label>
                        <select name="lang_type" id="lang_type" class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                            <option value="01" {{ ($facility->lang_type ?? '01') == '01' ? 'selected' : '' }}>韓国語</option>
                            <option value="02" {{ ($facility->lang_type ?? '') == '02' ? 'selected' : '' }}>英語</option>
                            <option value="03" {{ ($facility->lang_type ?? '') == '03' ? 'selected' : '' }}>日本語</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center space-x-4 mt-8">
                    <button type="submit" id="applyImg" class="rounded-lg font-bold shadow my-4 px-16 py-2 mt-8 text-white bg-sky-400 hover:bg-sky-500 focus:bg-sky-600">
                        適用
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {

            var originalImageSrc = $('#logoImage').attr('src');

            // 画像選択したとき、プレビュー表示
            $('#hsptl_image').on('change', function (event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var newSrc = e.target.result + '?t=' + new Date().getTime();
                        // プレビュー表示
                        if ($('#logoImage').length) {
                            $('#logoImage').attr('src', e.target.result).show();
                        } else {
                            // 新しい画像を追加
                            $('#defaultText').hide();
                            $('#logoImageContainer').html('<img src="' + e.target.result + '" alt="Logo" class="w-full h-auto max-h-40 object-contain" id="logoImage">');
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
        });

            // 削除ボタンを押した時、プレビューから画像を削除
            $('#imgDelBtn').on('click', function () {
                    $('#logoImage').remove();
                    $('#logoImageContainer').html('<span class="ml-3 text-sm" id="defaultText">画像をアップロードしてください</span>');
                    $('#hsptl_image').val('');
            })
            //適用ボタンを押した時、画像をアップロード
            $('#applyImg').on('click', function () {
                $('#imageForm').submit();
            });
            // ページロード時、デフォルトアイコンとテキストを非表示（サムネイルがある場合）
            if ($('#logoImage').length > 0) {
                $('#defaultText').hide();
            }
        });
    </script>
</body>
@endsection