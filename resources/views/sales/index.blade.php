@foreach ($sales as $sale)
    <div>{{ $sale->user->name }} bought {{ $sale->book->title }} for ${{ $sale->total_price }}</div>
@endforeach
