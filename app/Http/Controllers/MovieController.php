<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Inertia\Response;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of movies.
     */
    public function __invoke(Request $request): Response
    {
        return inertia('Movies/Index', [
            'movies' => Show::query()->movies()->paginate(24),
        ]);
    }
}
