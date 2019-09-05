<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $id = DB::table('product')->insertGetId([
            'name' => $request->name, 
            'description' => $request->description, 
            'price' => $request->price,
            'created_at' =>  Carbon::now()->toDateTimeString(),
            'updated_at' =>  Carbon::now()->toDateTimeString()
        ]);

        return response()->json([
            'message' => 'Success',
            'id' => $id
        ]);
    }

    public function get(){
        return response()->json([
            'message' => 'Success',
            'data' => DB::table('product')->get()
        ]);
    }

    public function getById($id, Request $request){
        return response()->json([
            'message' => 'Success',
            'data' => DB::table('product')->where('id', $id)->get()
        ]);
    }
}