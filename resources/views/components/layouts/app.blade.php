<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typing Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NG+Modern:wght@100..400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        body {
            font-family: 'Roboto', monospace; /* Default to Roboto */
            background-color: #1a202c; /* Dark blue */
            color: #e2e8f0; /* Light gray */
            line-height: 1.6;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
        .text-xl {
            font-size: 1.5rem;
            font-weight: bold;
            font-family: 'Playwrite NG Modern', sans-serif; /* Apply Playwrite NG Modern for headings */
        }
        .bg-blue-500 {
            background-color: #2b6cb0; /* Dark blue */
        }
        .text-white {
            color: #fff;
        }
        .rounded {
            border-radius: 0.25rem;
        }
        .p-4 {
            padding: 1rem;
        }
        .mb-4 {
            margin-bottom: 1rem;
        }
        .text-center {
            text-align: center;
        }
        .mt-4 {
            margin-top: 1rem;
        }
        .border {
            border: 1px solid #4a5568; /* Gray */
        }
        .rounded-lg {
            border-radius: 0.5rem;
        }
        .bg-gray-700 {
            background-color: #4a5568; /* Gray */
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <div class="container mx-auto">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
