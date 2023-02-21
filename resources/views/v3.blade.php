<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite('resources/css/app.css')
</head>
<body>
<div class="bg-white flex flex-col h-screen justify-between">
    <form action="/v3" method="post">
        @csrf

        <div class="mx-auto max-w-7xl py-16 px-6 sm:py-24 lg:px-8">
            <div class="text-center">
                {{--                <h2 class="text-lg flex-center justify-center">--}}
                {{--                    <span class="px-3 text-lg  text-indigo-300"><a href="/v1">V0.1</a></span>--}}
                {{--                    <span class="px-3 text-lg font-bold text-indigo-600">V0.2</span>--}}

                {{--                </h2>--}}
                <p class="mt-1 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">Convert any text
                    to spotify playlist</p>
                <p class="mx-auto mt-5 max-w-xl text-xl ">Type any text and convert it to a list of spotify
                    tracks.</p>
            </div>

            <div>
                <div class="mt-10 flex justify-center flex-center">
                    <textarea rows="4" name="text" id="text"
                              rows="6"
                              class="p-2 border-2 w-1/2 rounded-md border-zinc-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{$text ?? ''}}</textarea>
                </div>
                <div class="mt-5 flex justify-center ">
                    <button type="submit"
                            class=" rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Convert
                    </button>
                </div>
            </div>
        </div>

        @if(isset($results))
            <hr>
            <div class="md:container md:mx-auto fw-50 mt-10" fstyle="width: 70%;">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="flex min-w-full py-2 align-middle md:px-6 lg:px-8 justify-center center">
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg w-96 justify-center center">
                                    <table class="min-w-full divide-y divide-gray-300  justify-center center">
                                        {{--                                <thead class="bg-gray-50">--}}
                                        {{--                                <tr>--}}
                                        {{--                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>--}}
                                        {{--                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>--}}
                                        {{--                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>--}}
                                        {{--                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>--}}
                                        {{--                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">--}}
                                        {{--                                        <span class="sr-only">Edit</span>--}}
                                        {{--                                    </th>--}}
                                        {{--                                </tr>--}}
                                        {{--                                </thead>--}}
                                        <tbody class="divide-y divide-gray-200 bg-white">

                                        @if($results)
                                            @foreach($results as $key => $result)
                                                <tr>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                        <div class="flex items-center">
                                                            <div class="fh-20 w-10 fflex-shrink-0">
                                                                <i class="fa-solid fa-music"></i>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div
                                                                    class="font-medium text-gray-900">{{$result['name']}}</div>
                                                                <div class="text-gray-300">
                                                                    {{implode(',', $result['artist'])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @endforeach
                                                    @endif

                                                    {{--                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">--}}
                                                    {{--                                        <div class="text-gray-900">Front-end Developer</div>--}}
                                                    {{--                                        <div class="text-gray-500">Optimization</div>--}}
                                                    {{--                                    </td>--}}
                                                    {{--                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">--}}
                                                    {{--                                        <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>--}}
                                                    {{--                                    </td>--}}
                                                    {{--                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Member</td>--}}
                                                    {{--                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">--}}
                                                    {{--                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>--}}
                                                    {{--                                    </td>--}}
                                                </tr>

                                                <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>

    @if(isset($results))
        <form action="/v3/playlist/store">
            <input type="hidden" value="{{$text}}" name="text">

            <div class="mx-auto max-w-7xl py-16 px-6 sm:py-24 lg:px-8">
                <div class="text-center">
                    <button type="submit"
                            class=" rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save as playlist: {{$text}}
                    </button>
                </div>
            </div>
        </form>
    @endif


    @include('partials._footer')


</div>
</body>
</html>
