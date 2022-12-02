<?php

namespace Database\Seeders;

use App\Models\Right;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('rights') as $right) {
            $slug = Str::slug($right);

            Right::create([
                'name' => $right,
                'slug' => $slug,
            ]);
        }
    }
}
