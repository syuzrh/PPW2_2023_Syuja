@extends('auth.layouts')

@section('content')
<div class="flex justify-center mt-5">
    <div class="w-1/2 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">Login</h1>
        <form action="{{ route('authenticate') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" class="w-full p-2 border border-gray-300 rounded @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" class="w-full p-2 border border-gray-300 rounded @error('password') border-red-500 @enderror" id="password" name="password" placeholder="Enter your password">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
