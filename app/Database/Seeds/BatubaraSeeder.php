<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BatubaraSeeder extends Seeder
{
	public function __construct()
	{
		$this->batubara = \Config\Database::connect('batubara');
	}

	public function run()
	{
		//
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 150; $i++) {
		$data = [
			'name'        => $faker->name,
			'address'     => $faker->randomNumber($nbDigits = NULL, $strict = false),
			'created_at'  => Time::createFromTimestamp($faker->unixTime()),
			'updated_at'  => Time::now()
		];

		// Using Query Builder
		$this->batubara->table('peoples')->insert($data);
		}
	}
}
