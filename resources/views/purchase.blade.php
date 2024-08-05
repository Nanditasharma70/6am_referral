<!-- resources/views/purchase.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h1 class="text-2xl font-semibold mb-4">Purchase Form</h1>
        <form action="{{ route('purchase.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700">User ID</label>
                <input type="number" id="user_id" name="user_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Amount</label>
                <input type="number" id="amount" name="amount" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" step="0.01" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Submit</button>
        </form>
    </div>
</body>

</html>
