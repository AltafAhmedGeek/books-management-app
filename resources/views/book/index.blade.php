@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Books') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="GET" action="{{ route('book.index') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search books..."
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </form>

                        <a href="{{ route('book.create') }}" class="btn btn-primary mb-3">Add New Book</a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Description</th>
                                    <th>Published Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($book->published_date)->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('book.show', $book->id) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('book.edit', $book->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($books->isEmpty())
                            <p class="text-center">No books found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
