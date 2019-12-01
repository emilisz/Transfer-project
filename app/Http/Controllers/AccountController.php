<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = \Auth::user()->accounts[0]->account_number;
        return redirect('/home/'.$user);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Account::create([
            'user_id' => $request->user_id,
            'account_number' => 'LT'.rand(1000000000,9999999999),
            'balance' => 0
        ]);

        return redirect()->back()->with('status', 'Created one more account for you!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account,Request $request)
    {
      
        if (request()->segment(2) !== null) {
            $account = Account::where('user_id',\Auth::id())->where('account_number', request()->segment(2))->firstOrFail();
        } else {
            $account = Account::where('user_id',\Auth::id())->firstOrFail();
        }
        
        $myAccounts = Account::where('user_id',\Auth::id())->get();
        $allAccounts = Account::where('user_id','!=', \Auth::id())->with('user')->get();
        
        return view('accounts.index',compact('myAccounts','allAccounts','account'));
    }
    
}
