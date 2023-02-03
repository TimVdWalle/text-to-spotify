<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="bg-white">
    <form action="/" method="post">
        @csrf

        <div class="mx-auto max-w-7xl py-16 px-6 sm:py-24 lg:px-8">
            <div class="text-center">
                <h2 class="text-lg font-semibold text-indigo-600">V 0.1</h2>
                <p class="mt-1 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">Convert any text
                    to spotify playlist.</p>
                <p class="mx-auto mt-5 max-w-xl text-xl text-gray-500">Type any text and convert it to a list of spotify
                    tracks.</p>
            </div>

            <div>
                <div class="mt-10">
                    <textarea rows="4" name="comment" id="comment"
                              class="border-2 block w-full rounded-md border-zinc-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="mt-5 flex justify-center ">
                    <button type="submit"
                            class=" rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Convert
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
</body>
</html>
