<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // DB::table('users')->truncate();
        // DB::table('projects')->truncate();
        // DB::table('tasks')->truncate();
        

        DB::unprepared(File::get(base_path() . '/database/seeders/DatabaseTablesWithData/laravel_coalition_tech.sql'));

        // Project::factory(20)->create();
        // Task::factory(50)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');


    }
}
