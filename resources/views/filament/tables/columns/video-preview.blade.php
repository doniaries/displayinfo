@php
    $state = $getState();
@endphp

@if ($state)
    <div class="flex items-center justify-center">
        <div class="w-40 aspect-video rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
            <video class="w-full h-full object-cover" controls preload="metadata">
                <source src="{{ \Illuminate\Support\Facades\Storage::url($state) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
@endif
