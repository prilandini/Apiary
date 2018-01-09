<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'userId'=> 1,
            'postId'=> 1,
            'body'=> 'Any Post.'
        ]);
    }
}
