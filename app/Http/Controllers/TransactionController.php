<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Carbon\Carbon;

use App\User;
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
            $id = $request->input('order.'.$i .'.id');
            $qty = $request->input('order.'.$i .'.qty');

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

        $userId = User::select('id')
            ->where('email', $request->email)
            ->where('name', $request->user)
            ->get();
        
        if(!$userId){
            $userId = User::insertGetId([
                'name' => $request->user,
                'email' => $request->email,
                'password' => $request->user,
                'created_at' =>  Carbon::now()->toDateTimeString(),
                'updated_at' =>  Carbon::now()->toDateTimeString()
            ]);
        } else {
            $userId = $userId[0]['id'];
        }
          
        $trans = array(
            'id' => $transId,
            'userId' => $userId,
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
