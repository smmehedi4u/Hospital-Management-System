<?php

namespace Database\Seeders;
use App\Models\beds;
use App\Models\Patient;
use App\Models\Rooms;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class bedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $rooms = Rooms::all()->pluck('id')->toArray();
        $patients = Patient::all()->pluck('id')->toArray();

        for ($i=0; $i <5 ; $i++) {
            beds::create([
                'room_id'        => $faker->randomElement($rooms),
                'patient_id'     => $faker->randomElement($patients),
                'alloted_time'   => $faker->dateTimeBetween('-1 week', 'now')->format('Y-m-d H:i:s'),
                'discharge_time' => $faker->dateTimeBetween('now', '+1 week')->format('Y-m-d H:i:s'),
           ]);
    }
    }
}
