<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index($categoryName) {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $articles = $category->articles()->paginate(4);
        return view('category.index', compact('articles'));
    }

    public function create() {
        return view('category.create');
    }


    public function store(Request $request) {

        Validator::validate($request->post(),[
            'title' => 'required',
        ] , [
            'title.required' => 'عنوان رو وارد کن.'
        ]);


        Category::create([
            'name' => $request->post('title')
        ]);

        return back();
    }


}
