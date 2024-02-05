<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Tambah User</title>
    </head>
    <body class="h-screen bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <span class="my-5 text-3xl">Form Penambahan User</span>
            <div class="lg:w-1/4 md:w-1/3 sm:w-full">
                <form action="" method="post">
                    @csrf
                    @if($errors->has('name'))
                        <span class="bg-red-600 text-white rounded-md">{{ $errors->first('name') }}</span>
                    @endif
                    <div class="flex justify-between my-2">
                        <span class="w-1/4">Nama</span>
                        <x-forms.input/>
                    </div>
                    @if($errors->has('password'))
                        <span class="bg-red-600 text-white rounded-md">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="flex justify-between my-2">
                        <span class="w-1/4">Password</span>
                        <x-forms.inputpassword/>
                    </div>
                    <x-forms.submit message="Submit" class="bg-indigo-700 hover:bg-indigo-600"/>
                </form>
            </div>
        </div>
    </body>
</html>
