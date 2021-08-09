@extends('layouts.master')

@section('content')
    <div class="bg-gradient-to-b from-blue-500 to-indigo-500">
        <div class="flex flex-col items-center justify-center h-screen">
            <div class="w-full lg:w-1/3 p-4 shadow-lg bg-gray-900 rounded-t-lg">
                <h3 class="text-lg text-white">Login</h3>
            </div>
            <div class="lg:w-1/3 w-full bg-white p-6 rounded-b-lg">
                @include('includes.alert')
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm mb-1 capitalize" for="username">username</label>
                        <input type="text" name="username" id="username" class="px-3 py-2 w-full border @error('username') border-red-500 @enderror border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300" value="{{ old('username') }}"/>
                        @error('username')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm mb-1 capitalize" for="password">password</label>
                        <input type="password" name="password" id="password" class="px-3 py-2 w-full border  @error('password') border-red-500 @enderror border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300"/>
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <button class="bg-blue-500 focus:outline-none transition-colors duration-150 focus:ring-2 ring-blue-200 hover:bg-blue-600 px-4 py-2 rounded text-white float-right">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection