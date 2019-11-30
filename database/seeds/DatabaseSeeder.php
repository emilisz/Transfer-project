<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 10)->create()->each(function ($user) {
            factory(App\Account::class, 1)->create(['user_id'=>$user->id])->each(function ($account) use ($user){
                factory(App\Transfer::class, 10)->create(['user_id'=>$user->id, 'account_id' => $account->id]);
                });
            });

    }
}
