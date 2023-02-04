<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'year' => $this->year,
            'category' => $this->category,
            'rating' => $this->rating,
            'is_bookmarked' => $this->is_bookmarked,
            'is_trending' => $this->is_trending,
            'thumbnail_small' => $this->thumbnail_small,
            'thumbnail_medium' => $this->thumbnail_medium,
            'thumbnail_large' => $this->thumbnail_large,
        ];
    }
}
