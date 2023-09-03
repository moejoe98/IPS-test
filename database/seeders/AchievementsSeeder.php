<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            Achievement::create([
                'title' => 'First Comment Written',
                'type' => 'comment',
                'rank' => 1,
            ]);
            Achievement::create([
                'title' => '3 Comment Written',
                'type' => 'comment',
                'rank' => 3,
            ]);
            Achievement::create([
                'title' => '5 Comment Written',
                'type' => 'comment',
                'rank' => 5,
            ]);
            Achievement::create([
                'title' => '10 Comment Written',
                'type' => 'comment',
                'rank' => 10,
            ]);
            Achievement::create([
                'title' => '20 Comment Written',
                'type' => 'comment',
                'rank' => 20,
            ]);

            Achievement::create([
                'title' => 'First Lesson Written',
                'type' => 'lesson',
                'rank' => 1,
            ]);
            Achievement::create([
                'title' => '5 Lesson Written',
                'type' => 'lesson',
                'rank' => 5,
            ]);
            Achievement::create([
                'title' => '10 Lesson Written',
                'type' => 'lesson',
                'rank' => 10,
            ]);
            Achievement::create([
                'title' => '25 Lesson Written',
                'type' => 'lesson',
                'rank' => 25,
            ]);
            Achievement::create([
                'title' => '50 Lesson Written',
                'type' => 'lesson',
                'rank' => 50,
            ]);

            DB::commit();
            $this->command->info('Achievements records inserted successfully!');
        } catch (\Exception $exp) {
            DB::rollBack();
            $this->command->alert('something went wrong in Achievements seeder');
        }
    }
}