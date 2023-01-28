<?php

use App\Enums\ShowCategory;
use App\Models\Show;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\put;
use function Pest\Laravel\delete;

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

it('has tv series page', function () {
    $tvseries = Show::factory()->count(3)->tvseries()->create();

    get('/tv-series')
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('TVSeries/Index')
                ->has('tvseries.data',3, fn($page) => $page
                    ->whereAll([
                        'title' => $tvseries->first()->title,
                        'year' => $tvseries->first()->year,
                        'category' => ShowCategory::TVSERIES->value,
                        'rating' => $tvseries->first()->rating,
                        'is_bookmarked' => $tvseries->first()->is_bookmarked,
                        'is_trending' => $tvseries->first()->is_trending,
                    ])
                    ->etc(),
                )
        );
});

it('can bookmark a show', function () {
    $show = Show::factory()->create([
        'is_bookmarked' => false,
    ]);

    put('/shows/' . $show->id . '/bookmark')
        ->assertNoContent();

    $show->refresh();

    expect($show->is_bookmarked)->toBeTrue();
});

it('can unbookmark a show', function () {
    $show = Show::factory()->create([
        'is_bookmarked' => true,
    ]);

    delete('/shows/' . $show->id . '/unbookmark')
        ->assertNoContent();

    $show->refresh();

    expect($show->is_bookmarked)->toBeFalse();
});