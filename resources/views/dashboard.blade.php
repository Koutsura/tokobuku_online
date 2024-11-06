<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Buku Online</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Welcome, {{ Auth::user()->name }}!</h2>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

        <!-- Books List -->
        <h3 class="mt-4">Books</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->description }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ $book->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Sales List -->
        <h3 class="mt-4">Sales</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->user->name }}</td>
                    <td>{{ $sale->book->title }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->total_price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Book Form -->
        <h3 class="mt-4">Add Book</h3>
        <form method="POST" action="{{ route('addBook') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category:</label>
                <select name="category_id" class="form-select">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>

        <!-- Add Sale Form -->
        <h3 class="mt-4">Add Sale</h3>
        <form method="POST" action="{{ route('addSale') }}">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User:</label>
                <select name="user_id" class="form-select">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book_id" class="form-label">Book:</label>
                <select name="book_id" class="form-select">
                    @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Sale</button>
        </form>

        <!-- Add Category Form -->
        <h3 class="mt-4">Add Category</h3>
        <form method="POST" action="{{ route('addCategory') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (optional for additional functionality like modal, dropdown, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
