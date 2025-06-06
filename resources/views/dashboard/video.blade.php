<x-layouts.app :title="__('Dashboard - Videos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Videos</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($videos as $video)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <a href="{{ $video->url }}" target="_blank">
                        <img src="{{ $video->thumbnail_url ?? 'https://via.placeholder.com/320x180' }}" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $video->title }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $video->description ?? 'No description available.' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                    No videos found
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app> 