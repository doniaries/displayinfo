<div x-data="clock()" x-init="startClock()"
    class="w-full font-mono text-4xl font-bold tracking-widest text-center text-white">
    <span x-text="formattedTime"></span>
</div>

@push('scripts')
    <script>
        function clock() {
            return {
                formattedTime: '00:00:00',
                startClock() {
                    setInterval(() => {
                        const now = new Date();
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        this.formattedTime = `${hours}:${minutes}:${seconds}`;
                    }, 1000);
                }
            }
        }
    </script>
@endpush
