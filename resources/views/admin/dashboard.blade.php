<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-xl ">
                    <h4>Products</h4>
                </div>

                <div class="p-6">
                    <a href="{{route('products.create')}}" class="text-blue-500 hover:underline">Create New Product</a>
                </div>

                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Likes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{$product->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$product->description}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$product->price}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <i class="fa-light fa-thumbs-up">{{ $product->likes_count }}</i>                            
                                <i class="fa-light fa-thumbs-down">{{ $product->dislikes_count }}</i>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route('products.edit', $product->id)}}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{route('products.destroy', $product->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
