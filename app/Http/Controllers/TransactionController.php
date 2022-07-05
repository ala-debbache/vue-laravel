<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with(['client.user','provider.user','products'])->get();
        return $transactions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();
        $transaction = Transaction::create($validated);
        if (!empty($request->products)) {
            foreach ($request->products as $product) {
                $transaction->products()->attach($product['product']['id'], [
                    'price' => $product['product']['price'],
                    'quantity' => $product['quantity'],
                ]);
            }
        }
        return $transaction;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, $id)
    {
        $validated = $request->validated();
        $transaction = Transaction::where('id',$id)->with('products')->first();
        foreach($transaction->products as $product){
            $transaction->products()->detach($product['id']);
        }
        if (!empty($request->products)) {
            foreach ($request->products as $product) {
                $transaction->products()->attach($product['product']['id'], [
                    'price' => $product['product']['price'],
                    'quantity' => $product['quantity'],
                ]);
            }
        }
        return $transaction->update([
            'client_id' => $request->client_id,
            'provider_id' => $request->provider_id,
            'total' => $request->total,
        ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::where('id',$id)->with('products')->first();
        $products = $transaction->products;
        foreach($transaction->products as $product){
            $transaction->products()->detach($product['id']);
        }
        return $transaction->delete();
    }
}
