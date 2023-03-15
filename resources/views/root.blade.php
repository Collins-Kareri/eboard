<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/cf619e81e7.js" crossorigin="anonymous"></script>
        @spladeHead
        @vite(['resources/js/app.js'])
    </head>

    <body class="font-sans antialiased overflow-hidden scroll_container">
        @splade
    </body>

</html>
