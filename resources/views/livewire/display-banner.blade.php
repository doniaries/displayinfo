<div class="relative w-full h-full" id="bannerContainer">
    <style>
        .banner-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .banner-slide.active {
            opacity: 1;
        }

        .banner-image {
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            object-fit: cover;
            /* Ensures the image covers the entire area */
            border-radius: 0.5rem;
        }
    </style>

    @if ($banners->isNotEmpty())
        <div class="relative h-full" id="slideshow">
            @foreach ($banners as $key => $banner)
                <div class="banner-slide {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($banner->gambar) }}" alt="{{ $banner->keterangan_gambar }}"
                        class="banner-image" onerror="this.src='{{ asset('images/placeholder.png') }}'">
                    @if ($banner->keterangan_gambar)
                        <div class="absolute right-0 bottom-0 left-0 p-2 bg-black bg-opacity-50">
                            <p class="text-sm text-center text-white">{{ $banner->keterangan_gambar }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="flex justify-center items-center h-full">
            <p class="text-white">Tidak ada banner tersedia</p>
        </div>
    @endif

    @push('scripts')
        <script>
            function initSlideshow() {
                const slides = document.querySelectorAll('.banner-slide');
                if (slides.length === 0) return;

                let currentSlide = 0;

                function showSlide(index) {
                    slides.forEach(slide => slide.classList.remove('active'));
                    slides[index].classList.add('active');
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }

                showSlide(0);
                setInterval(nextSlide, 5000); // Change slide every 5 seconds
            }

            document.addEventListener('DOMContentLoaded', initSlideshow);

            document.addEventListener('livewire:init', () => {
                initSlideshow();
                Livewire.on('banner-updated', () => {
                    setTimeout(initSlideshow, 100);
                });
            });
        </script>
    @endpush
</div>
