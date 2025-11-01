<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       for($id =1;$id<=3;$id++){
          
          DB::table('users')->insert([
            'name'=>"user $id",
            'email'=>"user $id@email.com",
            'password'=>bcrypt("user $id"),
            'email_verified_at'=> now(),
            'created_at'=>now()
          ]);
       }
    }
}
