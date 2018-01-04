<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::resource('/users', 'UserController');

Route::get('/', function () {

    // DB::table('users')->insert([
    //     'name' => 'pril',
    //     'username' => 'priland',
    //     'email' => 'pril44@gmail.com',
    //     'street' => 'teuku umar',
    //     'suite' => 'contoh',
    //     'city' => 'bandung',
    //     'phone' => '8765432',
    //     'company' => json_encode([
    //         'name' => 'roma',
    //         'catchPhrase' => 'multi',
    //         'bs' => 'hard'
    //     ]),
    //     'password' => bcrypt('secret'),
    // ]);
    
    // $user = App\User::first();
    
    // $address = [
    //     "id" => $user->id,
    //     "name" => $user->name,
    //     "username" => $user->username,
    //     "email" => $user->email,
    //     "address" => [
    //         "street" => $user->street,
    //         "suite" => $user->suite,
    //         "city" => $user->city,
    //         "zipcode" => $user->zipcode,
    //         "geo" => [
    //             "lat" => $user->lat,
    //             "lng" => $user->lng,
    //             ]
    //         ],
    //     "phone" => $user->phone,
    //     "company" => json_decode($user->company)
    //     ];

    

    // return $address;
});
