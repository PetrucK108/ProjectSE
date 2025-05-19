@extends('Sidebar.sidebar')
@section('content')
    <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>FutsalMatcher</title>
                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            </head>
            <body class="flex">
            <div class="flex-1 p-8">
                @yield('content')
            </div>
            </body>
        </html>

    <h1 class="text-3xl font-bold text-gray-800 mb-4"></h1>
    
@endsection

