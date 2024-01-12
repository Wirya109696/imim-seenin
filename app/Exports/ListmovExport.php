<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\User;
use App\Models\Listmov;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ListmovExport implements FromCollection
{

    private $list;

    // public function __construct(Listmov $list)
    // {
    //     $this->list = $list;
    // }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $categories = Category::all(['id', 'name'])->toArray();
        foreach ($categories as $category) {
            $category['id'] = $category['name']; // Replace 'id' with the actual column name of category IDs
        }
        $user = Auth::user();
        return Listmov::where('user_id', $user->id)->get(['title', 'slug', $categories, 'excerpt', 'body','created_at']);
    //    return Listmov::where('user_id', auth()->user()->id)->get();
    }
}
