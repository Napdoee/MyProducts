<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i <= 5; $i++) {
            Teacher::create([
                'nama' => $faker->name('female'),
                'tgl_lahir' => $faker->date,
                'alamat' => $faker->address,
                'no_telp' => $faker->e164PhoneNumber
            ]);
        }
    }
}
