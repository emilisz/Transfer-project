<?php

namespace App\Http\Controllers;

use App\Transfer;
use App\Account;
use Illuminate\Http\Request;
use Auth;

class TransferController extends Controller
{
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

        return redirect()->back()->with('status', 'Money successfully transfered to account '.$request->receiver_account_number);
    }

}
