<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => url('/').'/'.$this->picture,
            'description' => $this->when($request->route()->parameter('book'), $this->description),
            'authors' => $this->authors()->get()->implode('author', ','),
            'genres' => $this->genres()->get()->implode('genre', ','),
        ];
    }
}
