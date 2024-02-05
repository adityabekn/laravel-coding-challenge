<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Fibonacci</title>
    </head>
    <body class="h-screen bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <span class="my-5 text-3xl">Fibonacci</span>
            @error("status")
            <span class="bg-yellow-200 text-amber-700 text-center w-1/6 my-2 p-1">{{ $message }}</span>
            @enderror
            <div class="lg:w-1/4 md:w-1/3 sm:w-full">
                <form action="{{ route("store") }}" method="post">
                    @csrf
                    <div class="flex justify-between">
                        <span class="py-1 w-1/3">Rows</span>
                        <input type="text" name="rows" id="rows" pattern="[0-9]" required title="Masukkan Angka"
                               value="{{ old("rows") }}"
                               class="border rounded-md py-1 px-2 text-sm flex-grow my-1">
                    </div>
                    <div class="flex justify-between">
                        <span class="py-1 w-1/3">Columns</span>
                        <input type="text" name="columns" id="columns" pattern="[0-9]" required
                               value="{{ old("columns") }}"
                               class="border rounded-md py-1 px-2 text-sm flex-grow my-1">
                    </div>
                    <input type="submit" value="Submit"
                           class="my-5 bg-indigo-700 text-white p-1 rounded-md hover:bg-indigo-600 hover:cursor-pointer w-full">
                </form>
            </div>
            @if($request)
                @php $y = 0 @endphp
                <table class="border-2 border-gray-800 border-collapse text-center my-5">
                    @for($i = 0; $i < $request->columns; $i++)
                        <tr>
                            @for($x = 0; $x < $request->rows; $x++)
                                <td class="border-2 border-gray-800 border-collapse p-2">{{ $index[$y] }}</td>
                                @php $y++ @endphp
                            @endfor
                        </tr>
                    @endfor
                </table>
            @endif
        </div>
    </body>
</html>
