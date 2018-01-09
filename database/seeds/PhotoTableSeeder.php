<?php

use Illuminate\Database\Seeder;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'albumId'=> 1,
            'title'=> 'new photo',
            'url'=> 'http://placehold.it/600/24f355',
            'thumbnailUrl'=> 'http://placehold.it/600/24f355'
        ]);
    }
}
