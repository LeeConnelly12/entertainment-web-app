<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Inertia\Response;
use Illuminate\Http\Request;

class TVSeriesController extends Controller
{
    /**
     * Display a listing of TV series.
     */
    public function __invoke(Request $request): Response
    {
        return inertia('TVSeries/Index', [
            'tvseries' => Show::query()->tvseries()->paginate(24),
        ]);
    }
}
