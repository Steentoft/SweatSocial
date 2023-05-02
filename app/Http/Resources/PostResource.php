<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'post' => $this->content,
            'linkable' => $this->linkable,
            'images' => ImageResource::collection($this->images),
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
            'likes' => count($this->likes),
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
