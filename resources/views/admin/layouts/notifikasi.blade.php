@if(session('success'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition
        class="fixed top-5 right-5 bg-green-500 text-white px-6 py-4 rounded shadow-lg z-50 max-w-sm w-full"
    >
        <div class="flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-white ml-4 text-xl font-bold">&times;</button>
        </div>

        {{-- Animasi garis timer --}}
        <div class="h-1 bg-green-700 mt-3 relative overflow-hidden rounded">
            <div class="absolute left-0 top-0 h-full bg-white animate-timer-bar"></div>
        </div>
    </div>
@endif
@if(session('error'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition
        class="fixed top-5 right-5 bg-red-500 text-white px-6 py-4 rounded shadow-lg z-50 max-w-sm w-full"
    >
        <div class="flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button @click="show = false" class="text-white ml-4 text-xl font-bold">&times;</button>
        </div>

        {{-- Animasi garis timer --}}
        <div class="h-1 bg-red-700 mt-3 relative overflow-hidden rounded">
            <div class="absolute left-0 top-0 h-full bg-white animate-timer-bar"></div>
        </div>
    </div>
@endif

<style>
@keyframes timer-bar {
    from { width: 100%; }
    to { width: 0%; }
}

.animate-timer-bar {
    animation: timer-bar 3s linear forwards;
}
</style>
