<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Quản lý Công Việc</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="text-center space-y-6">
        <h1 class="text-5xl font-bold">Chào mừng đến với Task Manager</h1>
        <p class="text-lg text-gray-400">Quản lý công việc cá nhân hoặc nhóm dễ dàng và hiệu quả.</p>
        
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                Đăng nhập
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                Đăng ký
            </a>
        </div>
    </div>

</body>
</html>
