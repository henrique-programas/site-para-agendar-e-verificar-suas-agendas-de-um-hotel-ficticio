<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        /* CSS crítico para evitar flash branco antes do Vite/Tailwind */
        html, body { height: 100%; }
        html, body {
            background: #0a0806 !important;
            color: #f0e8d5;
            margin: 0;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: #0a0806; font-family: 'DM Sans', sans-serif; margin:0;">
    {{ $slot }}
</body>
</html>