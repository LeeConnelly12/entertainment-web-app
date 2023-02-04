<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowResource;
use App\Models\Show;
use Illuminate\Http\Request;
use Inertia\Response;

class TVSeriesController extends Controller
{
    /**
     * Display a listing of TV series.
     */
    public function __invoke(Request $request): Response
    {
        $tvseries = Show::query()->tvseries()->paginate(24);

        return inertia('TVSeries/Index', [
            'tvseries' => ShowResource::collection($tvseries),
        ]);
    }
}
