<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
    <style>
        .animated-gradient {
            background: linear-gradient(-45deg,
                    #ee7752,
                    #e73c7e,
                    #23a6d5,
                    #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .btn-glow:hover {
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
        }

        .logo-glow {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));
            animation: logoGlow 3s ease-in-out infinite;
        }

        @keyframes logoGlow {

            0%,
            100% {
                filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));
            }

            50% {
                filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.8)) drop-shadow(0 0 30px rgba(255, 255, 255, 0.4)) drop-shadow(0 0 40px rgba(82, 168, 236, 0.6));
                transform: scale(1.02);
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="min-h-screen animated-gradient">
    <div class="flex flex-col justify-center items-center p-4 min-h-screen backdrop-blur bg-white/10">
        {{-- Logo dan Informasi --}}
        <div class="mb-8 text-center">
            @php
                $setting = \App\Models\Setting::first();
            @endphp

            @if ($setting?->logo)
                <div class="relative">
                    <img src="{{ Storage::url($setting->logo) }}" alt="Logo"
                        class="relative z-10 mx-auto mb-4 w-auto h-32 logo-glow">
                    <div class="absolute inset-0 rounded-full blur-xl scale-150 bg-blue-500/20 -z-10"></div>
                </div>
            @endif

            <h1 class="mb-2 text-4xl font-bold text-white drop-shadow-lg">
                {{ config('app.name') }}
            </h1>

            @if ($setting)
                <h2 class="text-2xl drop-shadow-md text-white/90">
                    {{ $setting->nama_institusi }}
                </h2>
                <p class="text-white/80">
                    {{ $setting->alamat }}, {{ $setting->nagari }}
                </p>
            @endif
        </div>

        {{-- Tombol Aksi dengan warna gradien --}}
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('filament.admin.auth.login') }}"
                class="px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-purple-600 to-blue-500 rounded-lg transition-all duration-300 transform hover:from-purple-700 hover:to-blue-600 hover:-translate-y-1 btn-glow hover:shadow-xl">
                Login Admin
            </a>
            <a href="{{ route('display') }}"
                class="px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-teal-400 to-emerald-500 rounded-lg transition-all duration-300 transform hover:from-teal-500 hover:to-emerald-600 hover:-translate-y-1 btn-glow hover:shadow-xl">
                Lihat Display
            </a>
        </div>
    </div>
</body>

</html>
