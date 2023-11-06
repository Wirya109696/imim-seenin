<?php

namespace App\Http\Controllers;

use App\Models\Listmov;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Tests\Models\Post;
use \Cviebrock\EloquentSluggable\Services\SlugService;



class DashboardListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('dashboard.list.index', [
            'lists' => Listmov::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('dashboard.list.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:listmovs',
            'category_id' => 'required',
            'image'=> 'image|file|max:1024',
            'body' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('list-image');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit($request->body, 200);

        Listmov::create($validatedData);
        return redirect('/dashboard/list')->with('success', 'New List Has Been Added !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listmov  $list
     * @return \Illuminate\Http\Response
     */
    public function show($lists)
    {

        // if($lists->author->id !== auth()->user()->id) {
        //     abort(403);
        // }

        return view ('dashboard.list.show', [
            'lists' => Listmov::where('slug', $lists)->first()
            ]);
        // return (Listmov::where('slug', $lists)->first());
        // return $list;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\List  $listmov
     * @return \Illuminate\Http\Response
     */
    public function edit(Listmov $list)
    {
        if($list->author->id !== auth()->user()->id) {
            abort(403);
        }
        return view ('dashboard.list.edit', [
            'list'=> $list,
            'categories'=> Category::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listmov  $listmov
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listmov $list)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image'=> 'image|file|max:1024',
            'body' => 'required'
        ];


        if($request->slug != $list->slug) {
            $rules['slug'] = 'required|unique:listmovs';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('list-image');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit($request->body, 200);

        Listmov::where('id', $list->id)->update($validatedData);
        return redirect('/dashboard/list')->with('success', 'List Has Been Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listmov  $listmov
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listmov $list)
    {
        if($list->image){
            Storage::delete($list->image);
        }

        Listmov::destroy($list->id);
        return redirect('/dashboard/list')->with('success', 'List Has Been Delete !');
    }

    public function cekSlug(Request $request){
        $slug = SlugService::createSlug(Listmov::class, 'slug' , $request->slug);
        return response()->json(['slug' => $slug]);
    }
}
