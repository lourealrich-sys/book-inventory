<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">book report</h2>
            <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to books</a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            <form method="GET" action="{{ route('books.report') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ request('name') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" @selected(request('category') == $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock status</label>
                    <select name="stock_status" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All stock statuses</option>
                        <option value="In stock" @selected(request('stock_status') == 'In stock')>In stock</option>
                        <option value="Out of stock" @selected(request('stock_status') == 'Out of stock')>Out of stock</option>
                    </select>
                </div>
                <div class="flex items-center gap-4">
                    <button type="submit" class="px-4 py-2.5 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">APPLY FILTERS</button>
                    <a href="{{ route('books.report') }}" class="text-sm text-gray-600 hover:text-gray-900">Clear</a>
                </div>
            </form>

            <div class="mt-4 flex justify-end gap-3">
                <a href="{{ route('books.export.pdf', request()->query()) }}" class="px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800">DOWNLOAD PDF</a>
                <a href="{{ route('books.export.csv', request()->query()) }}" class="px-4 py-2 bg-green-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800">DOWNLOAD CSV</a>
            </div>
        </div>

        <div class="bg-white p-6 shadow-sm sm:rounded-lg overflow-x-auto">
            <p class="text-sm text-gray-600 mb-4">Showing {{ $books->count() }} books</p>

            @if($books->isEmpty())
                <p class="py-10 text-center text-sm text-gray-500">No books match the selected filters.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 font-medium">
                        <tr>
                            <th class="px-4 py-3">book name</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Unit price</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Stock status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($books as $book)
                            <tr>
                                <td class="px-4 py-3.5 font-medium text-gray-900">{{ $book->name }}</td>
                                <td class="px-4 py-3.5 text-gray-600">{{ $book->category }}</td>
                                <td class="px-4 py-3.5 text-gray-600">{{ number_format($book->unit_price, 2) }}</td>
                                <td class="px-4 py-3.5 text-gray-600">{{ $book->description }}</td>
                                <td class="px-4 py-3.5 text-gray-600">{{ $book->stock_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>