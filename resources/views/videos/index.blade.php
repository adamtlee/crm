<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Videos</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white rounded-lg border border-gray-200 shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">Title</th>
                    <th class="px-4 py-2 text-left font-semibold">Description</th>
                    <th class="px-4 py-2 text-left font-semibold">URL</th>
                    <th class="px-4 py-2 text-left font-semibold">Thumbnail URL</th>
                    <th class="px-4 py-2 text-left font-semibold">Duration</th>
                    <th class="px-4 py-2 text-left font-semibold">Views</th>
                    <th class="px-4 py-2 text-center font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $video->title }}</td>
                        <td class="px-4 py-2">{{ $video->description }}</td>
                        <td class="px-4 py-2">{{ $video->url }}</td>
                        <td class="px-4 py-2">{{ $video->thumbnail_url }}</td>
                        <td class="px-4 py-2">{{ $video->duration }}</td>
                        <td class="px-4 py-2">{{ $video->views }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('videos.edit', $video) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('videos.destroy', $video) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('videos.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Video</a>
</div>

</body>
</html>