@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Book Details') }}</div>

                    <div class="card-body">
                        <h3>{{ $book->title }}</h3>
                        <p><strong>{{ __('Author:') }}</strong> {{ $book->author }}</p>
                        <p><strong>{{ __('Published Date:') }}</strong> {{ $book->published_date }}</p>
                        <p><strong>{{ __('Description:') }}</strong></p>
                        <p>{{ $book->description ?? 'No description available.' }}</p>

                        <a href="{{ route('book.index') }}" class="btn btn-primary">Back to Books</a>
                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
