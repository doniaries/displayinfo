<!-- resources/views/livewire/display-agenda.blade.php -->
<div class="overflow-y-auto max-h-[calc(100vh-15rem)] space-y-2">
    @if ($agendas->isNotEmpty())
        @foreach ($agendas as $agenda)
            <div class="p-2 text-sm rounded bg-white/90">
                <h3 class="font-bold text-gray-800">{{ $agenda->nama_agenda }}</h3>
                <div class="mt-1 space-y-0.5">
                    <p class="text-black">
                        {{ \Carbon\Carbon::parse($agenda->tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </p>
                    <p class="text-black">{{ \Carbon\Carbon::parse($agenda->waktu)->format('H:i') }} WIB</p>
                    <p class="text-black">{{ $agenda->lokasi }}</p>
                </div>
            </div>
        @endforeach
    @else
        <div class="p-2 rounded bg-white/90">
            <p class="text-center text-gray-500">Tidak ada agenda</p>
        </div>
    @endif
</div>
