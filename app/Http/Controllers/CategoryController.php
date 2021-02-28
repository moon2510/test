<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use DB;

class CategoryController extends Controller
{
	public function listBooksById($category_id,Request $request)
    {
        $cate= Category::whereHas('books' , function($query) {
            $query->where('quantity' , '>' ,0  );
        }, '>', 0)->get();
        $paginate = isset($request->paginate) ? $request->paginate : 10;
        $orderby= isset($request->orderby) ? $request->orderby: 0;
        switch ($orderby) {
            case 1:  //name Z-A
            $data = Book::where('category_id','=',$category_id)->orderBy('name','DESC')->paginate($paginate);
            break;
            case 2: // newest
            $data = Book::where('category_id','=',$category_id)->orderBy('created_at','DESC')->paginate($paginate);
            break;
            case 3: //oldest
            $data = Book::where('category_id','=',$category_id)->orderBy('created_at')->paginate($paginate);
            break;
            case 4: //rating up
            $data = Book::withCount(['ratings as average_rating' => function($query) {$query->select(DB::raw('coalesce(avg(star_number),0)')); }])->where('category_id','=',$category_id)->orderBy('average_rating')->paginate($paginate);
            break;
            case 5: //rating down
            $data = Book::withCount(['ratings as average_rating' => function($query) {$query->select(DB::raw('coalesce(avg(star_number),0)')); }])->where('category_id','=',$category_id)->orderByDesc('average_rating')->paginate($paginate);
            break;
            default: //name A-Z
            $data = Book::where('category_id','=',$category_id)->orderBy('name')->paginate($paginate);
            break;
        }

        if($data->toArray()['total'] == 0 || $data == null){
            return abort(404);
        }
        return view('category',[
            'data' => $data,
            'categories' => $cate,
            'page_selection' => $paginate,
            'orderby' => $orderby
        ]);
    }

    public function listBookPaginate(Request $request){
        $category_id = $request->category;
        $paginate = $request->pagination;
        $orderby= isset($request->orderby) ? $request->orderby: 0;
        switch ($orderby) {
            case 1:  //name Z-A
            $data = Book::where('category_id','=',$category_id)->orderBy('name','DESC')->paginate($paginate);
            break;
            case 2: // newest
            $data = Book::where('category_id','=',$category_id)->orderBy('created_at','DESC')->paginate($paginate);
            break;
            case 3: //oldest
            $data = Book::where('category_id','=',$category_id)->orderBy('created_at')->paginate($paginate);
            break;
            case 4: //rating up
            $data = Book::withCount(['ratings as average_rating' => function($query) {$query->select(DB::raw('coalesce(avg(star_number),0)')); }])->where('category_id','=',$category_id)->orderBy('average_rating')->paginate($paginate);
            break;
            case 5: //rating down
            $data = Book::withCount(['ratings as average_rating' => function($query) {$query->select(DB::raw('coalesce(avg(star_number),0)')); }])->where('category_id','=',$category_id)->orderByDesc('average_rating')->paginate($paginate);
            break;
            default: //name A-Z
            $data = Book::where('category_id','=',$category_id)->orderBy('name')->paginate($paginate);
            break;
        }
        return view('layouts.list_book',[
           'data' => $data,
           'page_selection' => $paginate,
           'orderby' => $request->orderby
       ]);
    }
}
