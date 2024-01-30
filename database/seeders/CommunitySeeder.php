<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Community;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat objek Faker
        $faker = Faker::create();

        // Menentukan jumlah data yang ingin di-generate
        $numberOfRecords = 3;

        // Loop untuk men-generate data
        for ($i = 0; $i < $numberOfRecords; $i++) {
            // Memasukkan data menggunakan Eloquent
            Community::create([
                'id_komunitas' => $faker->unique()->uuid,
                'nama_komunitas' => $faker->company,
                'image_komunitas' => $faker->imageUrl(),
                'description_komunitas' => $faker->sentence,
                'KEY' => $faker->uuid,
                'id_kategori' => $faker->numberBetween(1, 3), // Sesuaikan dengan jumlah kategori yang Anda miliki
            ]);
        }
    }
}
