<?php

namespace App\Http\Controllers;

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
        ->take(10)
        ->get();
        return view('book-list',compact('books','search','listShown'));
    }
}
