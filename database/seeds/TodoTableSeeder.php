<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'userId'=> 1,
            'title'=> 'tidur',
            'completed'=> false
        ]);
    }
}
