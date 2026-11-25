@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">book name</label>
        <input type="text" name="name" value="{{ old('name', $book->name ?? '') }}" required class="w-full border-gray-300 rounded-md shadow-sm">
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(old('category', $book->category ?? '') === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Unit price</label>
            <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $book->unit_price ?? '') }}" required class="w-full border-gray-300 rounded-md shadow-sm">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Stock status</label>
        <select name="stock_status" class="w-full border-gray-300 rounded-md shadow-sm">
            <option value="In stock" @selected(old('stock_status', $book->stock_status ?? '') === 'In stock')>In stock</option>
            <option value="Out of stock" @selected(old('stock_status', $book->stock_status ?? '') === 'Out of stock')>Out of stock</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $book->description ?? '') }}</textarea>
    </div>
    <div class="flex items-center justify-end gap-3 pt-2">
        <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-green-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">{{ $buttonText }}</button>
    </div>
</div>