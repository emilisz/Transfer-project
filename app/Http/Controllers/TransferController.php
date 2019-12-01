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
            'amount' => 'required|numeric|min:0|not_in:0',
        ]);

            
            $ownerAccount = Account::findOrFail($request->account_id);
            $receiverAccount = Account::where('account_number', $request->receiver_account_number)->firstOrFail();
        
        if ($request->amount <= $ownerAccount->balance && $ownerAccount->exists() && $receiverAccount->exists()) {
            // NEW SENDER TRANSFER
                $transfer->addTransfer($validated, $validated['account_id'], false);
            // UPDATE SENDER ACCOUNT
                $ownerAccount->updateBalance(false, $request->amount);

            // UPDATE RECEIVER ACCOUNT
                $receiverAccount->updateBalance(true, $request->amount);
               
            // NEW RECEIVER TRANSFER
                $transfer->addTransfer($validated, $receiverAccount->id, true);


            return redirect()->back()->with('status', 'Money successfully transfered to account '.$request->receiver_account_number);
        } else {
            return redirect()->back()->with('status', 'Nice try, but transfer was unsuccessful. Please check all input fields and try again');
        }
        
    }

}
