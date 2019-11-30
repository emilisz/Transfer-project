<?php

namespace App\Http\Controllers;

use App\Transfer;
use App\Account;
use Illuminate\Http\Request;
use Auth;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $transfer = new Transfer;
        $transfer->user_id = Auth::id();
        $transfer->account_id = $request->account_id;
        $transfer->sender_account_number = $request->sender_account_number;
        $transfer->receiver_account_number = $request->receiver_account_number;
        $transfer->amount = -$request->amount;
        $transfer->save();

        $ownerAccount = Account::find($request->account_id);
        $ownerAccount->balance = $ownerAccount->balance - $request->amount;
        $ownerAccount->save();

        $receiverAccount = Account::where('account_number', $request->receiver_account_number)->firstOrFail();
        $receiverAccount->balance = $receiverAccount->balance + $request->amount;
        $receiverAccount->save();

        $transfer = new Transfer;
        $transfer->user_id = $receiverAccount->user->id;
        $transfer->account_id = $receiverAccount->id;
        $transfer->sender_account_number = $request->sender_account_number;
        $transfer->receiver_account_number = $request->receiver_account_number;
        $transfer->amount = $request->amount;
        $transfer->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
