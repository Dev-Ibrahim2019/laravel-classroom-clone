{{-- resources/views/errors/404.blade.php --}}

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الصفحة غير موجودة</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #f8f8f8;
            text-align: center;
            padding-top: 100px;
        }
        h1 {
            font-size: 48px;
            color: #e74c3c;
        }
        p {
            font-size: 20px;
            color: #555;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>404 - الصفحة غير موجودة</h1>
    <p>عذرًا، الصفحة التي تبحث عنها غير موجودة</p>
    <a href="{{ url('/') }}">العودة إلى الصفحة الرئيسية</a>
</body>
</html>
