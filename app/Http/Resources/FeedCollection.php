<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FeedCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'link' => $this->link,
            'date' => $this->date,
            'category' => $this->category,
            'newsId' => $this->newsId,
            'description' => $this->description,
            'comments' => $this->comments,
        ];
    }
}
