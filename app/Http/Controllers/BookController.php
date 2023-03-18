<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){

        $listShown = $request->listShown ;
        $search = $request->search ;

        if($listShown == null){
            $listShown = 10 ;
        }

        $books = Book::with('category')
        ->with('author')
        ->withAvg('review', 'rating')
        ->withCount('review')
        ->orderByDesc('review_avg_rating')
        ->orderByDesc('review_count')
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
            ->orWhereHas('author', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        })
        ->take($listShown)
        ->get();
        return view('book-list',compact('books','search','listShown'));
    }

    public function topAuthors(){
        $authors = Author::withCount(['review as voter' => function ($query){
            $query->where('rating' , '>' , 5);
        }],'rating')
        ->orderByDesc('voter')
        ->take(10)
        ->get();
        

        return view('top-authors',compact('authors'));
    }

    public function insertRating(Request $request){
        $authors = Author::orderBy('name','asc')->get();
        $bookAuthor = $request->author ;
        if($bookAuthor){
            $authorSelected = Author::findOrFail($bookAuthor);
        }else {
            $authorSelected = $authors->first();
        }
        $books = Book::with('author')
        ->where('author_id' , $authorSelected->id)
        ->get();

        if ($request->ajax()) {
            return view('book', [
                'books' => $books,
            ]);
        }
        $list = view('book', [
            'books' => $books,
        ])->render();

        return view ('insert-rating',compact('authorSelected','authors','list'));
    }

    public function storeRating(Request $request){
        Review::create([
            'book_id' => $request->book,
            'rating' => $request->rating
        ]);
        return redirect('/');
    }
}
