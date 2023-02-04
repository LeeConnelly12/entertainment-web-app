<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Response;

class BookmarkedShowController extends Controller
{
    /**
     * Update the show to be bookmarked.
     */
    public function update(Show $show): Response
    {
        $show->update([
            'is_bookmarked' => true,
        ]);

        return response()->noContent();
    }

    /**
     * Update the show to not be bookmarked.
     */
    public function destroy(Show $show): Response
    {
        $show->update([
            'is_bookmarked' => false,
        ]);

        return response()->noContent();
    }
}
