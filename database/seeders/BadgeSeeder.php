<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
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

            Badge::create([
                'title' => 'Beginner',
                'rank' => 0
            ]);
            Badge::create([
                'title' => 'Intermediate',
                'rank' => 4
            ]);
            Badge::create([
                'title' => 'Advanced',
                'rank' => 8
            ]);
            Badge::create([
                'title' => 'Master',
                'rank' => 10
            ]);

            DB::commit();
            $this->command->info('Badges records inserted successfully!');
        } catch (\Exception $exp) {
            DB::rollBack();
            $this->command->alert('something went wrong in Badges seeder');
        }
    }
}