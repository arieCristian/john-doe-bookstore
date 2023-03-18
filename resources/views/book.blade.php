@foreach ($books as $book)
<option value="{{ $book->id }}">{{ $book->name }}</option>
@endforeach
