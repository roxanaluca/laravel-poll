<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_id = (\App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'test12345'
        ]))->id;

        $id = (DB::table('poll_vote')->insertGetId([ 
            'user_id' => $user_id,
            'statement' => 'Hello World',
            'publish_date' => date('Y-m-d H:i:s'),
            'is_single_check' => true
        ]));

        DB::table('choice')->insert([ 
            'poll_vote_id' => $id,
            'statement' => 'A'
        ]);

        DB::table('choice')->insert([ 
            'poll_vote_id' => $id,
            'statement' => 'B'
        ]);
    }
}
