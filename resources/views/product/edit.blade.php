<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <a href="{{ route('product.index') }}"
                            class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Edit Product</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                Update details for <span class="font-medium text-gray-700 dark:text-gray-300">{{ $product->name }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- Form Utama - Ditambahkan 'novalidate' agar popup browser tidak muncul --}}
                    <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-5" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" 
                                class="w-full px-4 py-2.5 rounded-lg border text-sm {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-300 dark:border-gray-600' }} dark:bg-gray-700">
                            @error('name') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{-- Qty & Price --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="qty" name="qty" value="{{ old('qty', $product->qty) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm {{ $errors->has('qty') ? 'border-red-400 bg-red-50' : 'border-gray-300 dark:border-gray-600' }} dark:bg-gray-700">
                                @error('qty') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Price <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm {{ $errors->has('price') ? 'border-red-400 bg-red-50' : 'border-gray-300 dark:border-gray-600' }} dark:bg-gray-700">
                                @error('price') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Owner --}}
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Owner <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" name="user_id" 
                                class="w-full px-4 py-2.5 rounded-lg border text-sm {{ $errors->has('user_id') ? 'border-red-400 bg-red-50' : 'border-gray-300 dark:border-gray-600' }} dark:bg-gray-700">
                                <option value="">Select Owner --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $product->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('product.index') }}" 
                                class="px-4 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                                Update Product
                            </button>
                        </div>
                    </form>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <form action="{{ route('product.delete', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-500 hover:underline">
                            Delete this product permanentely
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>