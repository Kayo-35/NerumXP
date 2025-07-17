<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <table class="table">
        <tr>
            <td>Ola</td>
            <td>Como</td>
            <td>Vai?</td>
        </tr>
    </table>
</body>
</html>
