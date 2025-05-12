@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Pengaduan Saya</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form pengaduan / daftar pengaduan pribadi -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Daftar Pengaduan Anda</h2>
                <!-- Tampilkan pengaduan pribadi di sini -->
            </div>
        </div>
    </main>
</div>
@endsection
