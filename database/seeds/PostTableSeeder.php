<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'userId'=> 1,
            'title'=> 'First Post',
            'body' => 'This is user 1 first post.'
        ]);
    }
}
