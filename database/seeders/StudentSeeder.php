<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file::get(database_path('./data/student.json'));
        $students = collect(json_decode($json));

        $students->each(function ($student) {
            Student::create([
                'name'  => $student->name,
                'email' => $student->email,
                'age'   => $student->age,
                'city'  => $student->city,
            ]);
        });
    }
}
