<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listmov;
use App\Models\Category;
use Illuminate\Http\Request;

class ListController extends Controller
{

    public function index(){

        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }


        // dd(request('search'));
        return view('list', [
            "title" => "List Info".$title,
            "active" => "list",
            "list" => Listmov::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Listmov $list){
        return view('lists', [
            "title" => "Single List",
            "active" => "list",
            "lists" => $list
        ]);
    }
}
