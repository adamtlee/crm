<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prospect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Add Prospect</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prospects.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="first_name" class="block font-semibold">First Name</label>
            <input type="text" id="first_name" name="first_name" class="w-full border border-gray-300 rounded p-2" placeholder="John">
        </div>

        <div class="mb-4">
            <label for="last_name" class="block font-semibold">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="w-full border border-gray-300 rounded p-2" placeholder="Doe">
        </div>

        <div class="mb-4">
            <label for="email_address" class="block font-semibold">Email Address</label>
            <input type="email" id="email_address" name="email_address" class="w-full border border-gray-300 rounded p-2" placeholder="john.doe@example.com">
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block font-semibold">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="w-full border border-gray-300 rounded p-2" placeholder="123-456-7890">
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea id="description" name="description" class="w-full border border-gray-300 rounded p-2" placeholder="Description about the prospect..."></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
    </form>
</div>

</body>
</html>
