<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #1f2937; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        th { background-color: #f9fafb; }
    </style>
</head>
<body>
    <h2>book Report (Total: {{ $books->count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>book name</th>
                <th>Category</th>
                <th>Unit price</th>
                <th>Description</th>
                <th>Stock status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->category }}</td>
                    <td>{{ number_format($book->unit_price, 2) }}</td>
                    <td>{{ $book->description }}</td>
                    <td>{{ $book->stock_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>