@extends('layouts.common')
@section('title', 'CSV一括登録')
@section('content')
<div class="container mt-5">
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="bg-white shadow-md">
                <div class="p-6 bg-sky-400 text-white">CSV ファイルをアップロードしてください。</div>
                <div class="p-6">
                    <form method="POST" action="{{ route('csv-upload') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-5">
                            <label for="csv_file" class="block">CSV ファイル</label>
                            <input type="file" id="csv_file" name="csv_file" class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md">
                        </div>

                        <button type="submit" class="bg-sky-400 text-white px-4 py-2 rounded-md">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


