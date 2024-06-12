<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Tailwind cdn-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @livewireScripts
    <title>@yield('title') - Smart Hospital</title>
</head>
<body>
    @livewire('navigation-menu')
    <header class="text-gray-600 body-font bg-sky-200 shadow-lg">
        @if(session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div id="error-message" class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a href="/index" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" id="headerContent">
                <!--edit-->
                @if(session('image'))
                    <img src="{{ asset('images/' . session('image')) }}" alt="Logo" class="h-10" id="headerLogo">
                @else
                    <i class="fas fa-clinic-medical fa-2x" id="navBarIcon"></i>
                    <span class="ml-3 text-3xl" id="navBarText">Smart Hospital</span>
                @endif
            </a>
        </div>
    </header>
    <div class="flex min-h-screen h-auto bg-gray-100">
        <div class="w-64 bg-sky-100 p-4 shadow-lg" x-data="{ open: false }">
            <h2 class="text-3xl font-bold mb-4 text-center text-gray-600 cursor-pointer">
                <i class="fas fa-bars"></i>
                MENU
            </h2>
            <hr class="mb-4 border-sky-200">
            <ul class="text-center">
                <li class="mb-4 text-xl">
                    <a href="/index" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">ホーム</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/kanja-list" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">患者検索</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/kanja-create" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">患者登録</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/csv-page" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">CSV一括登録</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/image-upload" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">基本情報設定</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/master" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">マスターデータ確認</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/user-info" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">ユーザー一覧</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/user-approval" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">未承認ユーザー</a>
                </li>
                <hr class="mb-4 border-sky-200">
                <li class="mb-4 text-xl">
                    <a href="/ward-manager" class="block font-bold text-gray-500 hover:text-gray-800 transition duration-200">病棟管理者管理</a>
                </li>
                <hr class="mb-4 border-sky-200">
            </ul>
        </div>
        <div class="flex-grow p-6">
            @yield('content')
        </div>
    </div>    
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-message, #error-message").fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>