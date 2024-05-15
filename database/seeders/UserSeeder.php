<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Killiman',
            'email' => 'killimansaro0419@gmail.com',
            'password' => '$2y$10$Bdo1./.ga2g68dDXToKzjeOEy1spnkGkM8N5/HTeIcOrO05rC6nqi',
            'location'=>'New Dely',
            'company'=>'Helison',
            'active'=>'true',
            'role'=>'admin',
            'email_verified_at'=>'2024-03-28 16:28:34'
        
        ]);

        // $faker = Faker::create('id_ID');
 
    	// for($i = 1; $i <= 3; $i++){
 
    	//       // insert data ke table pegawai menggunakan Faker
    	// 	DB::table('users')->insert([
        //         'name' => $faker->name,
    	// 		'email' => $faker->email,
    	// 		'password' => $faker->password,
    	// 	]);
 
    	// }
    }
}
