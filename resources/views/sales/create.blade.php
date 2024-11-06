<form method="POST" action="{{ route('sales.store') }}">
    @csrf
    <select name="user_id">
        @foreach (\App\Models\User::all() as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <select name="book_id">
        @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
        @endforeach
    </select>
    <input type="number" name="quantity" placeholder="Quantity">
    <button type="submit">Create Sale</button>
</form>
