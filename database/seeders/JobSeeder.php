<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from file
        $jobListings = include database_path('seeders/data/job_listings.php');
        // Get user ids from user Model
        // $userIds = User::pluck('id')->toArray();

        // Get test user id
        $testUserId = User::where('email', 'test@test.com')->value('id');
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

        foreach ($jobListings as $index => $jobListing) {
            if ($index < 2) {
                // Assign the first two listings to the test user
                $jobListing['user_id'] = $testUserId;
            } else {

                $jobListing['user_id'] = $userIds[array_rand($userIds)];
            }

            // Add timestamps
            $jobListing['created_at'] = now();
            $jobListing['updated_at'] = now();

            DB::table('job_listings')->insert($jobListing);
            echo 'Job created successfully!';
        }
    }
}
