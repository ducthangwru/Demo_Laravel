<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make(123456)
        ]);
        \App\Models\User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make(123456)
        ]);
        factory(\App\Models\User::class, 10)->create();
    }
}
