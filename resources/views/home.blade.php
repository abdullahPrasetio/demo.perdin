@extends('layouts.backend')

@section('content')
    <div class="bg-gradient-to-b from-green-500 to-indigo-500 rounded-lg">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-6xl text-white">Halo, {{ $user->nama }}</h1>
            <p class="text-xl"> Selamat datang di demo aplikasi Perjalanan Dinas</p>
        </div>
    </div>
@endsection