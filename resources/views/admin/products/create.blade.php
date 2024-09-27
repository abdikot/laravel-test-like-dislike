<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Product Name:</label>
                            <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description:</label>
                            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700">Price:</label>
                            <input type="number" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
