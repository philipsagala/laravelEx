<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Carbon\Carbon;

use App\Transaction;
use App\TransactionDetail;
use App\ProductDetail;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $total = 0;
        $transDetail = array();
        $transId = Uuid::uuid4()->toString();

        for($i=0; $i<=5; $i++) {
            $id = $request->input($i .'.id');
            $qty = $request->input($i .'.qty');

            $item = ProductDetail::find($id);
            $item['product'];

            if($id) {
                $total = $total + ( $qty * $item['product']['price']);
                $transDetail[$i] = array(
                    "transactionId" => $transId,
                    "productId" => $id,
                    "qty" => $qty,
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'updated_at' =>  Carbon::now()->toDateTimeString()
                );

                $item->qty = $item->qty - $qty;
                $item->save();
            } else { break; }
        }

        $trans = array(
            'id' => $transId,
            'total' => $total,
            'created_at' =>  Carbon::now()->toDateTimeString(),
            'updated_at' =>  Carbon::now()->toDateTimeString()
        );

        Transaction::insert($trans);

        TransactionDetail::insert($transDetail);

        return response()->json([
            'message' => 'Success',
            'data' => $trans
        ]);
    }

    public function get(){
        return response()->json([
            'message' => 'Success',
            'data' => Transaction::all()
        ]);
    }
}
