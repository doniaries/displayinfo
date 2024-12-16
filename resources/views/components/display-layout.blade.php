<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->nama_aplikasi ?? 'Display Informasi' }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Digital Font - Perbaiki URL -->
    <link href="https://fonts.cdnfonts.com/css/digital-7-mono" rel="stylesheet">

    <style>
        @keyframes countdown {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-100%);
            }
        }

        /* Animasi Logo */
        @keyframes logoPulse {
            0% {
                transform: scale(1);
                filter: brightness(100%);
            }

            50% {
                transform: scale(1.05);
                filter: brightness(110%);
            }

            100% {
                transform: scale(1);
                filter: brightness(100%);
            }
        }

        .logo-animate {
            animation: logoPulse 3s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .logo-animate:hover {
            transform: translateY(-2px);
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .digital-clock {
            font-family: 'Digital-7 Mono', sans-serif;
        }

        /* Tambahan untuk smooth transition */
        .fade-transition {
            transition: opacity 0.5s ease-in-out;
        }
    </style>



    @livewireStyles
    {{-- <!-- Alpine.js - Gunakan versi spesifik -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <!-- Swiper CSS - Perbaiki URL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @stack('styles')
</head>

<body class="bg-white">
    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Scripts -->
    <!-- Letakkan scripts sebelum closing body -->
    @livewireScripts

    <!-- Swiper JS - Pastikan load setelah Livewire -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Base Script untuk handling Swiper -->
    <!-- Base Script untuk handling Swiper -->
    <script>
        let swiperInstances = [];
        let lastInteractionTime = Date.now();

        function initializeComponents() {
            swiperInstances.forEach(swiper => swiper.destroy());
            swiperInstances = [];

            const swiperElements = document.querySelectorAll('.banner-swiper');
            if (swiperElements.length > 0) {
                swiperElements.forEach(element => {
                    const swiper = new Swiper(element, {
                        loop: true,
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true
                        },
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        }
                    });
                    swiperInstances.push(swiper);
                });
            }
        }

        // Track user interaction
        document.addEventListener('mousemove', () => {
            lastInteractionTime = Date.now();
        });
        document.addEventListener('keydown', () => {
            lastInteractionTime = Date.now();
        });

        document.addEventListener('DOMContentLoaded', initializeComponents);

        document.addEventListener('livewire:init', () => {
            Livewire.on('banner-updated', () => {
                setTimeout(initializeComponents, 100);
            });
        });

        // Modified visibility handler
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                const inactiveTime = Date.now() - lastInteractionTime;
                // Only refresh if no interaction for more than 5 minutes
                if (inactiveTime > 300000) {
                    window.location.reload();
                }
            }
        });
    </script>

    <!-- Additional scripts from components -->
    @stack('scripts')
</body>

</html>
