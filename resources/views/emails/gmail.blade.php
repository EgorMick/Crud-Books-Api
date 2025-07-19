<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Письмо от Laravel</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        h1 {
            color: #2c3e50;
        }
        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #999999;
        }
        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Привет, друг!</h1>
    <p>
        Это письмо было отправлено из Laravel-проекта, чтобы проверить работу почтовой системы.
        Всё работает отлично, и ты на верном пути 🚀
    </p>

    <p>
        Ниже кнопка, которая может вести куда угодно. Просто для примера:
    </p>

    <a href="https://laravel.com" class="btn">Перейти на Laravel</a>

    <div class="footer">
        Это автоматическое письмо. Не отвечайте на него.<br>
        Laravel &copy; {{ date('Y') }}
    </div>
</div>
</body>
</html>
