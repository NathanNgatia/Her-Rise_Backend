<?php

namespace Database\Seeders;
//UserSeeder.php
use App\Models\Role;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $studentRole = Role::where('slug', 'student')->first();
        $jobsearcherRole = Role::where('slug', 'jobsearcher')->first();
        $mentorRole = Role::where('slug', 'mentor')->first();
        if (!$adminRole || !$studentRole || !$jobsearcherRole || !$mentorRole) {
            throw new Exception('Roles not found');
        }

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jobsearcher User',
            'email' => 'jobsearcher@example.com',
            'password' => Hash::make('password'),
            'role_id' => $jobsearcherRole->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Mentor User',
            'email' => 'mentor@example.com',
            'password' => Hash::make('password'),
            'role_id' => $mentorRole->id,
            'email_verified_at' => now(),
        ]);
    }
}