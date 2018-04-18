<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)
            ->create()
            ->each(function ($user) {
                factory(\App\Task::class, 5)
                    ->create(['user_id' => $user->id]);
            });
    }
}
