<!-- resources/views/livewire/display-quotes.blade.php -->
<div class="flex justify-center items-center h-full">
    @if (count($quotes) > 0)
        <div x-data="{
            quotes: @js($quotes),
            currentIndex: 0,
            currentQuote: '',
            init() {
                this.currentQuote = this.quotes[0].quote
                setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.quotes.length
                    this.currentQuote = this.quotes[this.currentIndex].quote
                }, 5000)
            }
        }" x-text="currentQuote" class="text-xl italic text-center text-black">
        </div>
    @else
        <p class="text-xl italic text-center text-black">Tidak ada quotes tersedia</p>
    @endif
</div>
