<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Daftar User</title>
    </head>
    <body class="h-screen bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <span class="my-5 text-3xl">Daftar User</span>
            @if(session('status'))
                <span class="bg-green-600 text-white rounded-md p-1">{{ session('status') }}</span>
            @endif
            <x-forms.link route="{{ route('add') }}" message="Tambah User"
                          class="bg-indigo-700 hover:bg-indigo-600"></x-forms.link>
            @if($listUser)
                <table class="border-2 border-gray-800 border-collapse">
                    <thead>
                        <tr>
                            <td class="border-2 border-gray-800 border-collapse p-2">No</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">Nama</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">Password</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">CTime</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">Fungsi</td>
                        </tr>
                    </thead>
                    @foreach($listUser as $users)
                        <tr>
                            <td class="border-2 border-gray-800 border-collapse p-2">{{ $loop->index + 1 }}</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">{{ $users->name }}</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">{{ $users->password }}</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">{{ $users->created_at }}</td>
                            <td class="border-2 border-gray-800 border-collapse p-2">
                                <div class="flex flex-row gap-1">
                                    <x-forms.link route="{{ route('edit', ['id' => $users->id]) }}" message="Edit"
                                                  class="bg-blue-700 hover:bg-blue-600"></x-forms.link>
                                    <form action="{{ route('destroy', ['id' => $users->id]) }}" method="post">
                                        @csrf
                                        <x-forms.submit message="Delete" class="hover:bg-red-600 bg-red-800"/>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <x-forms.submit message="Logout" class="bg-indigo-700 hover:bg-indigo-600"/>
            </form>
        </div>
    </body>
</html>
