{{-- resources/views/livewire/jadwal-sholat.blade.php --}}
<div class="h-full scale-90 md:scale-100">
    @if ($jadwal && isset($jadwal['jadwal']))
        <div class="flex flex-col h-full text-white">
            <div class="flex flex-col h-full">
                <div class="mb-4 text-center">
                    {{-- <h2 class="text-2xl font-bold">JADWAL SHALAT</h2> --}}
                    {{-- Lokasi Sholat --}}
                    <div class="mt-2">
                        <p class="text-xl">{{ $jadwal['lokasi'] }}</p>
                    </div>
                </div>

                <div class="flex flex-col flex-1 gap-2">
                    {{-- Subuh --}}
                    <div class="bg-gradient-to-r from-sky-600 to-blue-700 rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <span class="font-bold text-2lg">Subuh</span>
                            <span class="font-bold text-2lg">{{ $jadwal['jadwal']['subuh'] }}</span>
                        </div>
                    </div>
                    {{-- Duha --}}
                    <div class="bg-gradient-to-r from-rose-600 to-pink-700 rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <span class="font-bold text-2lg">Duha</span>
                            <span class="font-bold text-2lg">{{ $jadwal['jadwal']['dhuha'] }}</span>
                        </div>
                    </div>
                    {{-- Dzuhur --}}
                    <div class="bg-gradient-to-r from-violet-600 to-indigo-700 rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <span class="font-bold text-2lg">Dzuhur</span>
                            <span class="font-bold text-2lg">{{ $jadwal['jadwal']['dzuhur'] }}</span>
                        </div>
                    </div>
                    {{-- Ashar --}}
                    <div class="bg-gradient-to-r from-emerald-600 to-green-700 rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <span class="font-bold text-2lg">Ashar</span>
                            <span class="font-bold text-2lg">{{ $jadwal['jadwal']['ashar'] }}</span>
                        </div>
                    </div>
                    {{-- Maghrib --}}
                    <div class="bg-gradient-to-r from-orange-600 to-amber-700 rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <span class="font-bold text-2lg">Maghrib</span>
                            <span class="font-bold text-2lg">{{ $jadwal['jadwal']['maghrib'] }}</span>
                        </div>
                    </div>
                    {{-- Isya --}}
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-700 rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <span class="font-bold text-2lg">Isya</span>
                            <span class="font-bold text-2lg">{{ $jadwal['jadwal']['isya'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-center items-center h-full text-white">
            <p class="text-lg">Jadwal tidak tersedia</p>
        </div>
    @endif
</div>
