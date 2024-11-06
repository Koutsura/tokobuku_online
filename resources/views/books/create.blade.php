<form method="POST" action="{{ route('books.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <textarea name="description"></textarea>
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="number" name="stock" placeholder="Stock">
    <input type="number" name="price" placeholder="Price">
    <button type="submit">Create Book</button>
</form>
