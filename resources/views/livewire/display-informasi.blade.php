<div class="h-full">
    {{-- Container untuk slides --}}
    <div id="informasi-slides" class="relative h-full">
        @forelse($informasiList as $index => $info)
            <div class="absolute inset-0 p-3 opacity-0 transition-opacity duration-500 ease-in-out informasi-slide"
                style="{{ $index === 0 ? 'opacity: 1' : '' }}">
                <div class="bg-white/10 rounded-lg p-3 h-full">
                    <h3 class="text-lg font-bold text-white mb-2">{{ $info['judul'] }}</h3>
                    <p class="text-white/90 text-sm leading-relaxed">{{ $info['isi'] }}</p>
                </div>
            </div>
        @empty
            <div class="flex items-center justify-center h-full">
                <p class="text-white/70 text-center">Belum ada informasi</p>
            </div>
        @endforelse
    </div>

    <style>
        .informasi-slide {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
    </style>
</div>

@push('scripts')
    <script>
        let informasiInterval;

        function initInformasiSlideshow() {
            const slides = document.querySelectorAll('.informasi-slide');
            if (slides.length <= 1) return;

            let currentSlide = 0;
            const slideInterval = 5000; // 5 detik per slide

            if (informasiInterval) {
                clearInterval(informasiInterval);
            }

            function showSlide(index) {
                slides.forEach(slide => {
                    slide.style.opacity = '0';
                    slide.style.zIndex = '0';
                });
                slides[index].style.opacity = '1';
                slides[index].style.zIndex = '1';
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            showSlide(0);
            informasiInterval = setInterval(nextSlide, slideInterval);
        }

        // Initialize on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initInformasiSlideshow);
        } else {
            initInformasiSlideshow();
        }

        // Handle Livewire updates
        document.addEventListener('livewire:initialized', () => {
            initInformasiSlideshow();
            Livewire.on('informasi-updated', initInformasiSlideshow);
        });
    </script>
@endpush
