@foreach ($books as $book)
    <div>{{ $book->title }} - {{ $book->category->name }} - {{ $book->price }}</div>
@endforeach
