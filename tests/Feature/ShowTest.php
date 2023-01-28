<?php

use App\Enums\ShowCategory;
use App\Models\Show;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('has movies page', function () {
    $movies = Show::factory()->count(3)->movie()->create();

    get('/movies')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Movies/Index')
            ->has('movies.data', 3, fn($page) => $page
                ->whereAll([
                    'title' => $movies->first()->title,
                    'year' => $movies->first()->year,
                    'category' => ShowCategory::MOVIE->value,
                    'rating' => $movies->first()->rating,
                    'is_bookmarked' => $movies->first()->is_bookmarked,
                    'is_trending' => $movies->first()->is_trending,
                ])
                ->etc(),
            )
        );
});