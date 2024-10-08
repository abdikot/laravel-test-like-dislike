<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-xl">
                    <h4>Products</h4>
                </div>

                <div class="p-6">
                    <a href="#" id="createProduct" class="text-blue-500 hover:underline">Create New Product</a>
                </div>

                <div class="container pb-2">
                    <table id="products-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider max-w-10">Name</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider max-w-64">Description</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider max-w-7">Price</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider max-w-7">Likes</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider max-w-7">Dislikes</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200"></tbody>
                    </table>
                </div>

                <div id="createProductModal" class="fixed z-10 inset-0 overflow-y-auto" style="display:none;">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Create New Product</h3>
                                <form id="createProductForm">
                                    @csrf
                                    <div class="mt-2">
                                        <label for="name" class="block text-gray-700">Name:</label>
                                        <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="description" class="block text-gray-700">Description:</label>
                                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                                    </div>
                                    <div class="mt-2">
                                        <label for="price" class="block text-gray-700">Price:</label>
                                        <input type="number" id="price" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
                                        <button type="button" id="closeCreateModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="editProductModal" class="fixed z-10 inset-0 overflow-y-auto" style="display:none;">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Product</h3>
                                <form id="editProductForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="mt-2">
                                        <label for="edit-name" class="block text-gray-700">Name:</label>
                                        <input type="text" id="edit-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="edit-description" class="block text-gray-700">Description:</label>
                                        <textarea id="edit-description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                                    </div>
                                    <div class="mt-2">
                                        <label for="edit-price" class="block text-gray-700">Price:</label>
                                        <input type="number" id="edit-price" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                                        <button type="button" id="closeEditModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.dashboard') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'price', name: 'price', searchable: true, orderable: true},
                    {data: 'likes_count', name: 'likes_count', searchable: true, orderable: true },
                    {data: 'dislikes_count', name: 'dislikes_count' , searchable: true, orderable: true},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            })


            $('#createProduct').on('click', function() {
                $('#createProductModal').show();
            });

            $('#closeCreateModal').on('click', function() {
                $('#createProductModal').hide();
            });

            $('#createProductForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('products.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createProductModal').hide();
                        $('#createProductForm')[0].reset(); 
                        $('#products-table').DataTable().ajax.reload();
                        // $('tbody').append(`
                        //     <tr id="product-${response.id}">
                        //         <td class="px-6 py-4 whitespace-nowrap">${response.name}</td>
                        //         <td class="px-6 py-4 whitespace-nowrap">${response.description}</td>
                        //         <td class="px-6 py-4 whitespace-nowrap">${response.price}</td>

                        //         <td class="px-6 py-4 whitespace-nowrap">
                        //             <i class="fa-regular fa-thumbs-up"></i> 0 <!-- Placeholder for likes count -->
                        //         </td>
                        //         <td class="px-6 py-4 whitespace-nowrap">
                        //             <i class="fa-regular fa-thumbs-down"></i> 0 <!-- Placeholder for dislikes count -->
                        //         </td>
                        //         <td class="px-6 py-4 whitespace-nowrap">
                        //             <a href="#" class="text-blue-500 hover:underline editProduct" data-id="${response.id}">Edit</a>
                        //             <form action="products/${response.id}" method="POST" class="inline deleteProductForm" data-id="${response.id}">
                        //                 @csrf
                        //                 @method('DELETE')
                        //                 <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        //             </form>
                        //         </td>
                        //     </tr>
                        // `);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.editProduct', function(e) {
                e.preventDefault();
                console.log('Edit button clicked'); 

                let productId = $(this).data('id');

                $.get(`/admin/products/${productId}/edit`, function(product) {
                    console.log('Product data received:', product); 
                    $('#edit-name').val(product.name);
                    $('#edit-description').val(product.description);
                    $('#edit-price').val(product.price);
                    $('#editProductModal').data('productId', productId).show();
                }).fail(function(xhr) {
                    console.log('Failed to retrieve product data:', xhr.responseText); 
                });

                $('#closeEditModal').on('click', function() {
                    $('#editProductModal').hide();
                });

                $('#editProductForm').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    let productId = $('#editProductModal').data('productId');

                    $.ajax({
                        url: `/admin/products/${productId}`,
                        method: 'PUT',
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#editProductModal').hide();
                            $('#products-table').DataTable().ajax.reload();
                            $(`#product-${productId}`).find('td:nth-child(1)').text(response.name);
                            $(`#product-${productId}`).find('td:nth-child(2)').text(response.description);
                            $(`#product-${productId}`).find('td:nth-child(3)').text(response.price);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });

            $(document).on('submit', '.deleteProductForm', function(e) {
                e.preventDefault();
                let form = $(this);
                let productId = form.data('id');

                // let productName = $(`#product-${productId}`).find('td:nth-child(1)').text(); 
                let confirmDelete = confirm(`Apakah Anda yakin ingin menghapus Product?`);
                if (confirmDelete) {
                    $.ajax({
                        url: form.attr('action'),
                        method: 'DELETE',
                        data: form.serialize(),
                        success: function() {
                            $(`#product-${productId}`).remove();
                            $('#products-table').DataTable().ajax.reload();
                            alert(`Product "${productName}" telah dihapus.`); 
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    console.log('Penghapusan dibatalkan.');
                }
            });
        });
    </script>
</x-app-layout>
