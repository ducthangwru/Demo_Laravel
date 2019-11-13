<?php

use Illuminate\Database\Seeder;

class OAuth2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->call('passport:install', ['--force' => true]);
    }
}
