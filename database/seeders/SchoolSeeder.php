<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'name' => 'Jitegemee Secondary School',
                'code' => 'jitegemee',
                'description' => 'Jitegemee Secondary School - Excellence in Education',
                'address' => 'Dar es Salaam, Tanzania',
                'phone' => '+255 767 991 333/+255 716 542 777',
                'email' => 'jitegemeehighschool@sumajkt.go.tz',
                'status' => 'active',
            ],
            [
                'name' => 'Kawawa Secondary School',
                'code' => 'kawawa',
                'description' => 'Kawawa Secondary School - Building Future Leaders',
                'address' => 'Iringa, Tanzania',
                'phone' => '+255 22 2780934 / +255 713 411 223',
                'email' => 'kawawaschool@sumajkt.go.tz',
                'status' => 'active',
            ],
            [
                'name' => 'Makongo Secondary School',
                'code' => 'makongo',
                'description' => 'Makongo Secondary School - Quality Education for All',
                'address' => 'P.O. Box  60157 Dar es salaam, Tanzania',
                'phone' => ' 0755212465 / 0653426569',
                'email' => 'info@makongo.ac.tz',
                'status' => 'active',
            ],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }
    }
}
