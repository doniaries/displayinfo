<div class="w-full whitespace-nowrap bg-gradient-to-r from-black to-gray-800">
    <div class="marquee" style="animation-duration: {{ 100 / $speed }}s">
        @foreach ($texts as $text)
            <span class="mx-8 text-3xl text-white">{{ $text->text }}</span>
            @if ($logo)
                <img src="{{ Storage::url($logo) }}" alt="Logo" class="inline-block mx-4 h-10"
                    style="vertical-align: middle;">
            @endif
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        .marquee {
            display: inline-block;
            animation: marquee linear infinite;
            white-space: nowrap;
            padding: 0.75rem 0;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
@endpush
