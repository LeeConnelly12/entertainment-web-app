<?php

namespace Database\Seeders;

use App\Enums\ShowCategory;
use App\Models\Show;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            $slug = str($show['title'])->slug();

            return [
                'title' => $show['title'],
                'year' => $show['year'],
                'rating' => $show['rating'],
                'is_bookmarked' => $show['isBookmarked'],
                'is_trending' => $show['isTrending'],
                'category' => $show['category'] === 'Movie' ?
                    ShowCategory::MOVIE :
                    ShowCategory::TVSERIES,
                'thumbnail_small' => '/images/'.$slug.'/regular/small.jpg',
                'thumbnail_medium' => '/images/'.$slug.'/regular/medium.jpg',
                'thumbnail_large' => '/images/'.$slug.'/regular/large.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->all();

        Show::query()->insert($shows);
    }
}
