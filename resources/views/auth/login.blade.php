@extends('layouts.app')

@section('title', 'Login | Flowboard')

@section('content')

{{-- Success Modal --}}
@if(session('success'))
<div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden animate-fade-in">
        <div class="bg-emerald-500 px-6 py-4 flex items-center justify-between">
            <h5 class=" font-semibold text-lg">✓ Success</h5>
            <button onclick="document.getElementById('successModal').remove()"
                class=" hover:text-emerald-100 transition-colors text-xl leading-none">&times;</button>
        </div>
        <div class="px-6 py-5 text-gray-700">
            {!! session('success') !!}
        </div>
        <div class="px-6 pb-5 flex justify-end">
            <button onclick="document.getElementById('successModal').remove()"
                class="bg-emerald-500 hover:bg-emerald-600  px-6 py-2 rounded-lg font-medium transition-colors">
                OK
            </button>
        </div>
    </div>
</div>
@endif

{{-- Email Error Alert --}}
@if ($errors->has('email_address'))
<div id="errorToast" class="fixed bottom-6 right-6 z-50 bg-red-500  px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-fade-in">
    <span>⚠ {{ $errors->first('email_address') }}</span>
    <button onclick="document.getElementById('errorToast').remove()" class="/80 hover: text-lg leading-none">&times;</button>
</div>
@endif

{{-- Status Toast --}}
@if(session('status'))
<div id="statusToast" class="fixed bottom-6 right-6 z-50 bg-emerald-500  px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-fade-in">
    <span>✓ {{ session('status') }}</span>
    <button onclick="document.getElementById('statusToast').remove()" class="/80 hover: text-lg leading-none">&times;</button>
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('statusToast');
        if (toast) toast.remove();
    }, 4000);
</script>
@endif


{{-- Main Layout --}}
<div class="min-h-screen flex items-center justify-center px-4 py-12">

    <div class="relative w-full max-w-5xl flex flex-col md:flex-row items-center gap-12">

        {{-- Left: Illustration & Tagline --}}
        <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left">

            {{-- Logo / Brand --}}
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="sour-gummy text-3xl font-bold tracking-tight">Flowboard</span>
            </div>

            <img src="{{ asset('images/kanban method-rafiki-cropped.svg') }}" alt="Illustration"
                class="w-72 md:w-96 drop-shadow-2xl">

            <p class="short-stack-regular text-slate-400 text-base leading-relaxed max-w-sm mt-3">
                Organize your tasks, track your progress, and stay on top of everything — all in one place.
            </p>

            {{-- Feature Pills --}}
            <div class="flex flex-wrap gap-2 mt-2 justify-center md:justify-start">
                <span class="bg-blue-950 border border-blue-500/20 text-blue-300 text-xs px-3 py-1 rounded-full">📋 Kanban Board</span>
                <span class="bg-blue-950 border border-indigo-500/20 text-indigo-300 text-xs px-3 py-1 rounded-full">✅ Task Tracking</span>
                <span class="bg-blue-950 border border-slate-400/20 text-slate-400 text-xs px-3 py-1 rounded-full">🚀 Stay Productive</span>
            </div>
        </div>

        {{-- Right: Login Card --}}
        <div class="w-full max-w-md">
            <div class="bg-blue-950 backdrop-blur-xl ring-2 ring-inset ring-white/50 rounded-3xl p-8 shadow-2xl">

                <div class="mb-8">
                    <h3 class="sour-gummy text-white text-3xl font-bold tracking-tight mb-1">Welcome back!</h3>
                    <p class="text-slate-400 text-sm">Sign in to your Flowboard account</p>
                </div>

                <form action="{{-- route('login') --}}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email_address" class="block text-slate-300 text-sm font-medium">
                            Email address
                        </label>
                        <input
                            type="email"
                            id="email_address"
                            name="email_address"
                            placeholder="you@example.com"
                            class="w-full bg-white border border-white/20 text-gray-800 placeholder-gray-400 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all"
                            value="{{ old('email_address') }}"
                        >
                        @error('email_address')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label for="password" class="block text-slate-300 text-sm font-medium">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                class="w-full bg-white border border-white/20 text-gray-800 placeholder-gray-400 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all"
                            >
                            {{-- Toggle password visibility --}}
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 transition-colors">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember me & Forgot password --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="rememberPW"
                                class="w-4 h-4 rounded border-white/20 bg-white/5 text-blue-500 focus:ring-blue-500 focus:ring-offset-0">
                            <span class="text-slate-400 text-sm">Remember me</span>
                        </label>
                        <a href="#" class="text-blue-400 hover:text-blue-300 text-sm transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-500 active:bg-blue-700  font-semibold py-3 rounded-xl transition-all duration-200 shadow-lg shadow-blue-600/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 mt-2">
                        Sign in
                    </button>

                </form>

                {{-- Register Link --}}
                <p class="text-center text-slate-400 text-sm mt-6">
                    Don't have an account?
                    <a href="#" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                        Register now
                    </a>
                </p>

            </div>
        </div>

    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

@endsection