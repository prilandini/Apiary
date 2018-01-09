<?php

use Illuminate\Database\Seeder;
use function GuzzleHttp\json_encode;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'pril',
            'username'=> 'priland',
            'email'=> 'pril@gmail.com',
            'city'=> 'Bandung',
            'phone'=> '87654321',
            'password'=> bcrypt('pril44'),
            'company'=> json_encode([
                'name'=> 'Name of Company', 
                'catchPhrase'=> 'kjhgfds', 
                'bs'=> 'asfg'
            ])
        ]);
    }
}