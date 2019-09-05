<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class ProductDetailController extends Controller
{
    public function create(Request $request, $id)
    {
        $resultId = DB::table('product_detail')->insertGetId([
            'productId' => $id, 
            'color' => $request->color, 
            'size' => $request->size, 
            'qty' => $request->qty,
            'created_at' =>  Carbon::now()->toDateTimeString(),
            'updated_at' =>  Carbon::now()->toDateTimeString()
        ]);

        return response()->json([
            'message' => 'Success',
            'id' => $resultId
        ]);
    }

    public function get($id, Request $request){
        return response()->json([
            'message' => 'Success',
            'data' => DB::table('product_detail')->where('productId', $id)->get()
        ]);
    }
}