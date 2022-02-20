<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function search(Request $request) {
        $q = $request->q;
        if ($request->search_type == 'elastic') {
            $Files = File::search($request->q)->take(200)->get();
        }else{
            $Files = File::where(function($query) use ($q){
                return $query->where('name','Like','%'.$q.'%')->orWhere('description','Like','%'.$q.'%');
            })->get();

        }
        return view('welcome',compact('Files'));
    }
}
