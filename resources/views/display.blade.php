<!-- resources/views/display.blade.php -->
<x-display-layout>
    <div class="flex fixed inset-0 flex-col">
        <!-- Header Bar -->
        <div class="bg-gradient-to-r from-purple-500 via-blue-500 to-green-500">
            <div class="flex flex-col">
                <!-- Logo dan Nama -->
                <div class="flex justify-between items-center px-4 py-1">
                    <div class="flex flex-grow items-center">
                        <img src="{{ $setting->logo ? Storage::url($setting->logo) : asset('default/logo-default.png') }}"
                            alt="Logo" class="h-12 logo-animate">

                        <div class="flex flex-col flex-grow items-center">
                            <h1 class="text-lg font-bold text-white">{{ $setting->nama_aplikasi ?? 'Sistem Informasi' }}
                            </h1>
                            <p class="text-2xl font-bold text-white">{{ $setting->nama_institusi ?? 'Tidak Tersedia' }}
                            </p>
                        </div>
                    </div>
                    <!-- Tanggal -->
                    <div class="px-4 py-2 rounded-lg shadow-lg backdrop-blur-sm bg-white/20">
                        <p class="text-xl font-bold text-white" x-data x-init="setInterval(() => $el.textContent = new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }), 1000)">
                            {{ now()->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Main Content Area --}}
        <div class="grid overflow-hidden flex-1 grid-cols-12 gap-2 p-2 bg-gray-100">
            <!-- Left: Jam dan Jadwal Sholat -->
            <div class="flex flex-col col-span-2 gap-2">
                <!-- Jam -->
                <div class="h-16 bg-gradient-to-r from-blue-800 to-blue-600 rounded-lg shadow-xl">
                    <div class="flex justify-center items-center h-full">
                        <livewire:display-jam />
                    </div>
                </div>
                <!-- Jadwal Sholat -->
                <div
                    class="overflow-auto flex-1 bg-gradient-to-br from-indigo-600 via-blue-600 to-sky-600 rounded-lg shadow-xl">
                    <div class="p-3">
                        <h2 class="mb-2 text-xl font-bold text-center text-white">Jadwal Sholat</h2>
                        <livewire:display-jadwal-sholat />
                    </div>
                </div>
            </div>


            <!-- Center: Video & Quotes-Banner -->
            <div class="flex flex-col col-span-7 gap-2">
                <!-- Video Section - Kurangi tinggi -->
                <div class="h-[65%] bg-black rounded-lg shadow-xl overflow-hidden">
                    <div class="h-full">
                        <livewire:display-video>
                            <x-slot name="empty">
                                <div class="flex justify-center items-center h-full text-center text-white">
                                    <div>
                                        <svg class="mx-auto mb-4 w-12 h-12 text-white/30" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-lg">Tidak Ada Video</p>
                                        <p class="text-sm text-white/70">Silakan tambahkan video untuk ditampilkan</p>
                                    </div>
                                </div>
                            </x-slot>
                        </livewire:display-video>
                    </div>
                </div>

                <!-- Quotes & Banner Container -->
                <div class="h-[35%] flex gap-2">
                    <!-- Quotes -->
                    <div
                        class="overflow-hidden flex-1 bg-gradient-to-r from-yellow-300 to-orange-400 rounded-lg shadow-xl">
                        <div class="flex justify-center items-center px-4 h-full">
                            <livewire:display-quotes>
                                <x-slot name="empty">
                                    <div class="text-center text-gray-800">
                                        <p class="text-lg">Quotes Tidak Tersedia</p>
                                        <p class="text-sm opacity-75">Silakan tambahkan quotes untuk ditampilkan</p>
                                    </div>
                                </x-slot>
                            </livewire:display-quotes>
                        </div>
                    </div>
                    <!-- Banner -->
                    <div class="w-[350px] rounded-lg shadow-xl overflow-hidden">
                        <livewire:display-banner>
                            <x-slot name="empty">
                                <div class="flex justify-center items-center h-full text-center bg-gray-100">
                                    <div>
                                        <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-gray-600">Banner Tidak Tersedia</p>
                                    </div>
                                </div>
                            </x-slot>
                        </livewire:display-banner>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex flex-col col-span-3 gap-2">
                <!-- Agenda Section -->
                <div
                    class="overflow-auto flex-1 bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600 rounded-lg shadow-xl">
                    <div class="p-3">
                        <h2 class="mb-2 text-xl font-bold text-center text-white">Agenda</h2>
                        <livewire:display-agenda>
                            <x-slot name="empty">
                                <div class="text-center text-white">
                                    <p class="text-lg">Tidak Ada Agenda</p>
                                    <p class="text-sm opacity-75">Belum ada agenda yang dijadwalkan</p>
                                </div>
                            </x-slot>
                        </livewire:display-agenda>
                    </div>
                </div>

                <!-- Informasi Section -->

                <div
                    class="overflow-auto flex-1 bg-gradient-to-br from-violet-600 via-purple-600 to-fuchsia-600 rounded-lg shadow-xl">
                    <div class="p-3">
                        <h2 class="mb-2 text-xl font-bold text-center text-white">Informasi</h2>
                        <livewire:display-informasi>
                            <x-slot name="empty">
                                <div class="text-center text-white">
                                    <p class="text-lg">Tidak Ada Informasi</p>
                                    <p class="text-sm opacity-75">Belum ada informasi yang tersedia</p>
                                </div>
                            </x-slot>
                        </livewire:display-informasi>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="grid grid-cols-12 gap-1 p-1 h-12 bg-gray-100">
            <!-- Jam dengan z-index lebih tinggi -->
            {{-- <div class="z-10 col-span-2">
                <div
                    class="flex justify-center items-center h-full bg-gradient-to-r from-blue-800 to-blue-600 rounded-lg shadow-xl">
                    <livewire:display-jam />
                </div>
            </div> --}}
            <!-- Running Text -->
            <div class="overflow-hidden relative col-span-12">
                <div class="flex absolute inset-0 items-center">
                    <livewire:display-running-text>
                        <x-slot name="empty">
                            <div class="px-4 text-white">Tidak ada teks berjalan</div>
                        </x-slot>
                    </livewire:display-running-text>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Fullscreen -->
    <button onclick="toggleFullScreen()"
        class="fixed right-4 bottom-4 z-50 p-2 text-white bg-gray-800 rounded-full shadow-lg hover:bg-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0 4h-4m0 0l5-5m-7 11h4m-4 0v4m0 4h-4m0 0l5-5" />
        </svg>
    </button>

    <!-- Tombol Refresh -->
    <button onclick="location.reload()">Refresh</button>
    <button onclick="location.reload()"
        class="fixed bottom-4 right-16 z-50 p-2 text-white bg-gray-800 rounded-full shadow-lg hover:bg-gray-700 focus:outline-none">
        Refresh
    </button>

    @push('scripts')
        <script>
            // Debug flag
            const DEBUG = true;

            document.addEventListener('livewire:initialized', () => {
                if (DEBUG) console.log('Livewire initialized, setting up listeners');

                Livewire.on('refresh-quotes', () => {
                    if (DEBUG) console.log('refresh-quotes event received');
                    window.location.reload();
                });

                Livewire.on('echo:quotes,QuoteChanged', () => {
                    if (DEBUG) console.log('Quote changed event received');
                    window.location.reload();
                });
            });

            function toggleFullScreen() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                }
            }
        </script>
    @endpush
</x-display-layout>
