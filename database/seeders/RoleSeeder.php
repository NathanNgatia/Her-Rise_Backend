<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'System administrator with full access'
        ]);

        Role::create([
            'name' => 'Student',
            'slug' => 'student',
            'description' => 'Student user with student-related access'
        ]);

        Role::create([
            'name' => 'Jobsearcher',
            'slug' => 'jobsearcher',
            'description' => 'Jobsearcher user with job search-related access'
        ]);

        Role::create([
            'name' => 'Mentor',
            'slug' => 'mentor',
            'description' => 'Advisors user with advisors-related access'
        ]);
    }
}
