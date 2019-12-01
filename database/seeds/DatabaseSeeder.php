<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Account;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create([
                    'name'=> 'FAST INVEST'
                ]);

        factory(App\User::class, 10)->create()->each(function ($user) {
            factory(App\Account::class, 1)->create(['user_id'=>$user->id])->each(function ($account) use ($user){
                factory(App\Transfer::class, 2)->create([
                    'user_id'=>$user->id, 
                    'account_id' => $account->id,
                    'sender_account_number' => $account->account_number,
                    'receiver_account_number' => Account::all()->random()->account_number,
                ]);
                });
            });

    }
}
