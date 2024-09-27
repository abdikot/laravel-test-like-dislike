<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl mb-4">Products</h3>

                    @foreach($products as $product)
                        <div class="product-container mb-6 border-b pb-4" data-product-id="{{ $product->id }}">
                            <h4 class="text-lg font-bold">{{ $product->name }}</h4>
                            <p class="text-gray-600">{{ $product->description }}</p>
                            <p class="text-gray-800">Price: Rp {{ $product->price }}.000</p>

                            <div class="mt-4">
                                <button class="like-btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" 
                                        data-product-id="{{ $product->id }}" 
                                        data-like="1">
                                    Like ({{ $product->likes_count }})
                                </button>
                                <button class="dislike-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
                                        data-product-id="{{ $product->id }}" 
                                        data-like="0">
                                    Dislike ({{ $product->dislikes_count }})
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeButtons = document.querySelectorAll('.like-btn, .dislike-btn');

        likeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const isLike = this.dataset.like;

                fetch(`/product/${productId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ is_like: isLike })
                })
                .then(response => response.json())
                .then(data => {
                    const productElement = this.closest('.product-container');
                    productElement.querySelector('.like-btn').innerHTML = `Like (${data.likes})`;
                    productElement.querySelector('.dislike-btn').innerHTML = `Dislike (${data.dislikes})`;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>
</x-app-layout>
