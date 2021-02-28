<?php

namespace App\Http\Controllers;

use App\igration;
use Illuminate\Http\Request;
use App\Category;
use App\Book;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cate= Category::whereHas('books' , function($query) {
            $query->where('quantity' , '>' ,0  );
        }, '>', 0)->get();
        $category_id = (isset($request->category)) ? $request->category : -1;
        $orderby = (isset($request->orderby)) ? $request->orderby : 0;
        $paginate = (isset($request->paginate)) ? $request->paginate : 10;
        if ($request->keysearch == null) {
            return view('search',[
                'categories' => $cate,
                'data' => null,
                'category' => $category_id,
                'orderby' => $orderby,
                'paginate' => $paginate
            ]);
        }

        $books = Book::withCount(['ratings as average_rating' => function($query) {$query->select(DB::raw('coalesce(avg(star_number),0)')); }])->where('name', 'like', '%' . $request->keysearch . '%');
        if ($category_id >= 0) {
            $books = $books->where('category_id','=',$category_id);
        }
        if($orderby == 0){
           $books = $books->orderByDesc('average_rating')->paginate($paginate);
        }else{
            $books = $books->orderBy('average_rating')->paginate($paginate);
        }
        return view('search',[
            'key' => $request->keysearch,
            'categories' => $cate,
            'data' => $books,
            'category' => $category_id,
            'orderby' => $orderby,
            'paginate' => $paginate
        ]);
    }

    public function searchByName(Request $request)
    {
        $books = Book::where('name', 'like', '%' . $request->value . '%')->get();
        return response()->json($books); 
    }

    public function searchbyajax(Request $request)
    {
        $category_id = $request->category;
        $orderby = $request->orderby;        
        $paginate = $request->paginate;
        if($request->keysearch == "") return view('layouts.search_section',[
            'key' => null,
            'data' => null,
            'category' => $category_id,
            'orderby' => $orderby,
            'paginate' => $paginate
        ]);
            $books = Book::withCount(['ratings as average_rating' => function($query) {$query->select(DB::raw('coalesce(avg(star_number),0)')); }]);
            if($category_id >= 0){
                $books = $books->where('category_id','=',$category_id);
            }
            if($orderby == 0){
                $books = $books->where('name', 'like', '%' . $request->keysearch . '%')->orderByDesc('average_rating')->paginate($paginate);
            }else{
               $books = $books->where('name', 'like', '%' . $request->keysearch . '%')->orderBy('average_rating')->paginate($paginate);
           }
           return view('layouts.search_section',[
            'key' => $request->keysearch,
            'data' => $books,
            'category' => $category_id,
            'orderby' => $orderby,
            'paginate' => $paginate
        ]);
       }
   }
