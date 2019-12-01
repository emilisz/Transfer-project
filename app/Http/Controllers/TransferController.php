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
    public function store(Transfer $transfer,Request $request)
    {
       
        $validated = request()->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'sender_account_number' => 'required',
            'receiver_account_number' => 'required|min:12',
            'amount' => 'required',
        ]);

        $transfer->addTransfer($validated, $validated['account_id'], false);
        

    // UPDATE SENDER ACCOUNT
        $ownerAccount = Account::findOrFail($request->account_id);
        $ownerAccount->updateBalance(false, $request->amount);
       
    // UPDATE RECEIVER ACCOUNT
        $receiverAccount = Account::where('account_number', $request->receiver_account_number)->firstOrFail();
        $receiverAccount->updateBalance(true, $request->amount);
       
    // NEW RECEIVER TRANSFER
        $transfer->addTransfer($validated, $receiverAccount->id, true);

        return redirect()->back()->with('status', 'Money successfully transfered to account! '.$request->receiver_account_number);

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
