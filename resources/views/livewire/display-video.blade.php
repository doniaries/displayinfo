<div class="relative w-full h-full" id="video-container">
    <!-- Tambahkan class fullscreen-video -->
    <video id="videoPlayer" class="object-cover absolute inset-0 w-full h-full bg-black fullscreen-video" controls
        controlsList="nodownload" autoplay>
        <source src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Tambahkan tombol fullscreen khusus video -->
    <button id="videoFullscreenBtn"
        class="absolute right-4 bottom-4 z-50 p-2 text-white rounded-full bg-black/50 hover:bg-black/70 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0 0l-5-5m-7 11h4m-4 0v4m0 0l5-5m5 5v-4m0 4h-4m0 0l5-5" />
        </svg>
    </button>
</div>

@push('styles')
    <style>
        /* Style untuk mode fullscreen */
        .fullscreen-video:-webkit-full-screen {
            width: 100vw !important;
            height: 100vh !important;
            object-fit: cover !important;
        }

        .fullscreen-video:-moz-full-screen {
            width: 100vw !important;
            height: 100vh !important;
            object-fit: cover !important;
        }

        .fullscreen-video:fullscreen {
            width: 100vw !important;
            height: 100vh !important;
            object-fit: cover !important;
        }

        /* Sembunyikan tombol fullscreen bawaan video */
        video::-webkit-media-controls-fullscreen-button {
            display: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        class VideoManager {
            constructor(videos) {
                this.videos = videos;
                this.currentIndex = 0; // Mulai dari index 0 (video terbaru)
                this.videoElement = document.getElementById('videoPlayer');
                this.fullscreenBtn = document.getElementById('videoFullscreenBtn');
                this.isPlaying = false;

                this.initialize();
                this.setupFullscreenButton();
            }

            initialize() {
                if (this.videos.length === 0) return;

                // Mulai dari video pertama (terbaru)
                this.loadCurrentVideo();

                this.videoElement.addEventListener('ended', () => this.playNext());
                this.videoElement.addEventListener('error', () => {
                    console.log('Video error, moving to next...');
                    this.playNext();
                });

                this.videoElement.volume = 0.5;
            }

            loadCurrentVideo() {
                if (this.videos.length === 0) return;

                const video = this.videos[this.currentIndex];
                this.videoElement.src = video.url;
                this.videoElement.load();

                const playPromise = this.videoElement.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log("Auto-play prevented:", error);
                        // Retry play if auto-play is prevented
                        setTimeout(() => this.videoElement.play(), 1000);
                    });
                }
            }

            playNext() {
                this.videoElement.pause();
                this.videoElement.currentTime = 0;

                this.currentIndex++;
                if (this.currentIndex >= this.videos.length) {
                    this.currentIndex = 0;
                }

                this.loadCurrentVideo();
            }

            setupFullscreenButton() {
                this.fullscreenBtn.addEventListener('click', () => {
                    if (this.videoElement.requestFullscreen) {
                        this.videoElement.requestFullscreen();
                    } else if (this.videoElement.mozRequestFullScreen) { // Firefox
                        this.videoElement.mozRequestFullScreen();
                    } else if (this.videoElement.webkitRequestFullscreen) { // Chrome, Safari, and Opera
                        this.videoElement.webkitRequestFullscreen();
                    } else if (this.videoElement.msRequestFullscreen) { // IE/Edge
                        this.videoElement.msRequestFullscreen();
                    }
                });
            }

        }

        // Initialize video player
        let videoManager;
        document.addEventListener('livewire:initialized', () => {
            const videos = @json($videos);
            videoManager = new VideoManager(videos);
        });
    </script>
@endpush
