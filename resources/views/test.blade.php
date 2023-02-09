<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VirtualBD Ltd.</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-800 p-6 relative">

        @if(session()->has('message'))
            <div class="bg-green px-4 py-2 text-white rounded-md absolute top-10 right-10">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto p-6 bg-gray-600 rounded-md text-white mb-4">
            <p>First Name: {{$user->first_name}}</p>
            <p>Last name: {{$user->last_name}}</p>
            <p>Email: {{$user->email}}</p>
            <p>DOB: {{$user->birth_date}}</p>
            <p>Profession: {{$user->profession}}</p>
            <p>Phone: {{$user->phone}}</p>
            <p>Nationality: {{$user->nationality}}</p>
            <p>Blogger Name: {{$user->blogger_name}}</p>
        </div>
        <div class="max-w-7xl mx-auto p-6 bg-gray-600 rounded-md text-white">
            <form action="{{route('profileUpdate',1)}}" method="post" class="grid grid-cols-6 gap-5">
                @csrf
                @method('PUT')
                <input type="text" name="first_name" id="first_name" value="{{$user->first_name ? $user->first_name:''}}" placeholder="First Name" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="last_name" id="last_name" value="{{$user->last_name ? $user->last_name:''}}" placeholder="Last Name" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="email" id="email" value="{{$user->email ? $user->email:''}}" placeholder="Email" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="date" name="birth_date" id="birth_date" value="{{$user->birth_date ? $user->birth_date:''}}" placeholder="" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="profession" id="profession" value="{{$user->profession ? $user->profession:''}}" placeholder="Profession" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="phone" id="phone" value="{{$user->phone ? $user->phone:''}}" placeholder="Phone" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="nationality" id="nationality" value="{{$user->nationality ? $user->nationality:''}}" placeholder="Nationality" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="bio" id="bio" value="{{$user->bio ? $user->bio:''}}" placeholder="Bio" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <input type="text" name="blogger_name" id="blogger_name" value="{{$user->blogger_name ? $user->blogger_name:''}}" placeholder="Blogger Name" class="col-span-6 sm:col-span-3 my-2 text-gray-800 px-2 py-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">


                <div class="">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
            </form>
        </div>
    </body>
</html>
