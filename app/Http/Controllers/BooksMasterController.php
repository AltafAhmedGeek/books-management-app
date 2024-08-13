<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        $books = $query->get();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $book = Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'published_date' => $request->input('published_date'),
        ]);

        return redirect()->route('book.index')->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            return view('book.show', compact('book'));
        } else {
            return redirect()->route('book.index')->withErrors(['Book Not Found.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::find($id);
        if ($book) {
            return view('book.edit', compact('book'));
        } else {
            return redirect()->route('book.index')->withErrors(['Book Not Found.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $book->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'published_date' => $request->input('published_date'),
        ]);

        return redirect()->route('book.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book) {
            $deleted = $book->delete();
            if ($deleted) {
                return redirect()->route('book.index')->with('success', 'Book Deleted Successfully!');
            } else {
                return redirect()->route('book.index')->withErrors(['Error While Deleting Book.']);
            }
        } else {
            return redirect()->route('book.index')->withErrors(['Book Not Found.']);
        }
    }
}
