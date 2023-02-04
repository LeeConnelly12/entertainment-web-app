<?php

namespace Database\Seeders;

use App\Enums\ShowCategory;
use App\Models\Show;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Storage::disk('local')->get('data.json');

        $json = json_decode($data, true);

        $shows = collect($json)->map(function ($show) {
            return [
                'title' => $show['title'],
                'year' => $show['year'],
                'rating' => $show['rating'],
                'is_bookmarked' => $show['isBookmarked'],
                'is_trending' => $show['isTrending'],
                'category' => $show['category'] === 'Movie' ?
                    ShowCategory::MOVIE :
                    ShowCategory::TVSERIES,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->all();

        Show::query()->insert($shows);
    }
}
