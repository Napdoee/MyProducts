<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Products dummy and categories
        $this->call(ProductSeeder::class);

        //Create user for user roles
        \App\Models\User::factory(2)->create();

        //Create user with admin roles
        \App\Models\User::factory()->create([
            'firstname' => 'Rizku',
            'lastname' => 'Karbu',
            'address' => 'Jl. Manggis No.25, Sumatera Selatan',
            'name' => 'Napdoee',
            'email' => 'nap@doe.com',
            'email_verified_at' => now(),
            'roles' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        //More product dummy (optional)
        // $this->call(ProductDumpSeeder::class);
    }
}
