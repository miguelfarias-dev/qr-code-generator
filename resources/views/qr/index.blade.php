<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Generator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center transition-colors">

    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8 w-full max-w-xl transition-colors">

        <!-- DARK MODE -->
        <div class="flex justify-end mb-4">
            <button type="button" id="darkToggle"
                class="text-sm px-3 py-1 rounded-lg bg-gray-200 dark:bg-gray-700 dark:text-white transition">
                🌙
            </button>
        </div>

        <h1 class="text-2xl font-bold text-center mb-6 text-gray-900 dark:text-white">
            QR Code Generator
        </h1>

        <form method="POST" action="/download">
            @csrf

            <!-- TEXT -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Text / URL
                </label>

                <input id="textInput" type="text" name="text" placeholder="https://example.com"
                    class="w-full px-4 py-3 text-lg rounded-xl border border-gray-300 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        focus:ring-2 focus:ring-black focus:border-black 
                        shadow-sm outline-none transition"
                    required>
            </div>

            <!-- SIZE -->
            <div class="mt-5">
                <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                    Size: <span id="sizeValue">300</span>px
                </label>

                <input id="sizeInput" type="range" name="size" min="100" max="800" value="300"
                    class="w-full" oninput="sizeValue.innerText = this.value">
            </div>

            <!-- MARGIN -->
            <div class="mt-5">
                <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                    Margin: <span id="marginValue">4</span>
                </label>

                <input id="marginInput" type="range" name="margin" min="0" max="20" value="4"
                    class="w-full" oninput="marginValue.innerText = this.value">
            </div>

            <!-- LOGO UPLOAD -->
            <div class="mt-5">
                <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                    Upload Logo
                </label>

                <input type="file" id="logoInput" accept="image/*"
                    class="block w-full text-sm text-gray-500 dark:text-gray-300
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:text-sm file:font-semibold
                        file:bg-gray-200 file:text-gray-700
                        dark:file:bg-gray-600 dark:file:text-white
                        shover:file:opacity-80">
            </div>

            <!-- BUTTONS -->
            <div class="mt-6 flex gap-3">
                <button type="submit" name="format" value="svg"
                    class="flex-1 bg-black text-white py-3 rounded-xl hover:opacity-90 transition">
                    Download SVG
                </button>

                <button type="submit" name="format" value="png"
                    class="flex-1 bg-gray-700 text-white py-3 rounded-xl hover:opacity-90 transition">
                    Download PNG
                </button>
            </div>
        </form>

        <!-- PREVIEW -->
        <div id="previewContainer" class="mt-8 text-center hidden">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                Live Preview
            </p>

            <div class="inline-block p-4 bg-gray-50 dark:bg-gray-700 rounded-xl shadow-inner">
                <div class="relative inline-block">

                    <!-- QR -->
                    <img id="qrPreview" class="max-w-full h-auto" />

                    <!-- LOGO -->
                    <img id="qrLogo"
                        class="hidden absolute w-16 h-16 top-1/2 left-1/2 
                        -translate-x-1/2 -translate-y-1/2 
                        rounded-lg shadow">
                </div>
            </div>
        </div>

    </div>

</body>

</html>
