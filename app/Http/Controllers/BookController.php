<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
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
        // $authorsWithReviews = Author::withCount(['reviews as total_reviews_greater_than_5' => function ($query) {
        //     $query->where('rating', '>', 5);
        // }])
        // ->has('reviews', '>', 0)
        // ->get();

        $authors = Author::withCount(['review as voter' => function ($query){
            $query->where('rating' , '>' , 5);
        }],'rating')
        ->orderByDesc('voter')
        ->take(10)
        ->get();
        

        return view('top-authors',compact('authors'));
    }
}
