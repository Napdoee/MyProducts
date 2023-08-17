<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $induk = 'C012023001';
        for($i = 0; $i <= 5; $i++) {
            Student::create([
                // 'nama' => $faker->name('female'),
                // 'tgl_lahir' => $faker->date,
                // 'alamat' => $faker->address,
                // 'no_telp' => $faker->e164PhoneNumber,
                'induk'           => $induk++,
                'nama'            => $faker->name(),
                'jenis_kelamin'   => $faker->gender(),
                'tgl_lahir'       => $faker->date(),
                'alamat'          => $faker->address(),
                'nama_orang_tua'  => $faker->name(),
                'nomor_orang_tua' => $faker->e164PhoneNumber(),
            ]);
        }
    }
}
