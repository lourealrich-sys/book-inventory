<?php

namespace App\Http\Controllers;

use App\Models\book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $categories = ['Fiction', 'Non-fiction', 'Academic', 'Children'];

    private function filteredbooks(Request $request)
    {
        return book::query()
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', '%' . $request->name . '%'))
            ->when($request->filled('category'), fn($q) => $q->where('category', $request->category))
            ->when($request->filled('stock_status'), fn($q) => $q->where('stock_status', $request->stock_status))
            ->latest()
            ->get();
    }

    public function index(Request $request)
    {
        return view('books.index', [
            'books' => $this->filteredbooks($request),
            'categories' => $this->categories,
        ]);
    }

    public function create()
    {
        return view('books.create', [
            'categories' => $this->categories,
        ]);
    }

    public function store(Request $request)
    {
        book::create($request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Fiction,Non-fiction,Academic,Children',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock_status' => 'required|in:In stock,Out of stock',
        ]));

        return redirect()->route('books.index');
    }

    public function edit(book $book)
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => $this->categories,
        ]);
    }

    public function update(Request $request, book $book)
    {
        $book->update($request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Fiction,Non-fiction,Academic,Children',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock_status' => 'required|in:In stock,Out of stock',
        ]));

        return redirect()->route('books.index');
    }

    public function destroy(book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }

    public function report(Request $request)
    {
        return view('books.report', [
            'books' => $this->filteredbooks($request),
            'categories' => $this->categories,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $books = $this->filteredbooks($request);

        return Pdf::loadView('books.pdf', compact('books'))->download('book-report.pdf');
    }

    public function exportCsv(Request $request)
    {
        $books = $this->filteredbooks($request);

        return response()->stream(function () use ($books) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['book name', 'Category', 'Unit price', 'Description', 'Stock status']);
            foreach ($books as $p) {
                fputcsv($handle, [
                    $p->name,
                    $p->category,
                    number_format($p->unit_price, 2, '.', ''),
                    $p->description,
                    $p->stock_status,
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="book-report.csv"',
        ]);
    }
}