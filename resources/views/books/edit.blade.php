<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit book</h2>
            <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to books</a>
        </div>
    </x-slot>
    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            <form method="POST" action="{{ route('books.update', $book) }}">
                @method('PUT')
                @include('books._form', ['buttonText' => 'Update book'])
            </form>
        </div>
    </div>
</x-app-layout>