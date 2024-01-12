<?php

namespace App\Http\Controllers;

use App\Models\Listmov;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Exports\ListmovExport;
use App\Imports\ListmovImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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

        // $data = Listmov::where('user_id', auth()->user()->id)->get();

        return view('dashboard.list.index', compact('items'));
        // return response()->json($data);
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

        return view ('dashboard.list.show', [
            'lists' => Listmov::where('slug', $lists)->first()
            ]);

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

    public function export(){

        $user = Auth::user();
        $filename = 'imip_info_' . strtolower($user->name) . '.xlsx';

        return Excel::download(new ListmovExport, $filename);
        // return Excel::download(new ListmovExport($list),'listmov.xlsx');
    }

    public function import(Request $request){

        $file = $request->file('file');

        $namaFile = $file->getClientOriginalName();
        $file->move('datalist', $namaFile);

        Excel::import(new Listmovimport, public_path('/datalist/'.$namaFile));
        return redirect('/dashboard/list')->with('success','File Berhasil Import');


        // Excel::import(new ListmovImport, $file); // Ganti YourImportClass dengan class import Anda

        // return redirect()->route('importlistmov')
        //     ->with('success', 'Data berhasil diimpor.');
    }

    // public function export()
    // {
    //     // Get data to export (replace this with your own data retrieval logic)
    //     $data = [
    //         ['Name', 'Email'],
    //         ['John Doe', 'john@example.com'],
    //         ['Jane Doe', 'jane@example.com'],
    //     ];

    //     // Define Excel file name
    //     $fileName = 'exported_data.xlsx';

    //     // Export data using Maatwebsite\Excel\Facades\Excel
    //     Excel::create($fileName, function ($excel) use ($data) {
    //         $excel->sheet('Sheet 1', function ($sheet) use ($data) {
    //             $sheet->fromArray($data, null, 'A1', false, false);
    //         });
    //     })->export('xlsx');
    // }

    // public function import(Request $request)
    // {
    //     // Handle the uploaded file
    //     $file = $request->file('file');
    //     $path = $file->getRealPath();

    //     // Import data using Maatwebsite\Excel\Facades\Excel
    //     $data = Excel::load($path, function ($reader) {
    //     })->get();

    //     // Process the imported data (replace this with your own logic)
    //     foreach ($data as $row) {
    //         // Process each row
    //         // $row['column_name']
    //     }

    //     return redirect()->back()->with('success', 'Data imported successfully.');
    // }

}
