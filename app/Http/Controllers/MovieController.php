<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowResource;
use App\Models\Show;
use Illuminate\Http\Request;
use Inertia\Response;

class MovieController extends Controller
{
    /**
     * Display a listing of movies.
     */
    public function __invoke(Request $request): Response
    {
        $movies = Show::query()->movies()->paginate(24);

        return inertia('Movies/Index', [
            'movies' => ShowResource::collection($movies),
        ]);
    }
}
