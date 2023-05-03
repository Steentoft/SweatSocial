<?php

namespace App\Http\Resources;

use App\Models\Challenge;
use App\Models\Event;
use App\Models\Group;
use App\Models\Mealplan;
use App\Models\Workout;
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
            'user' => new CompactUserResource($this->user),
            'post' => $this->content,
            'linkable' => $this->when($this->whenLoaded('linkable'), function () {
                switch (true) {
                    case $this->linkable_type == 'challenge':
                        return new ChallengeResource($this->linkable);

                    case $this->linkable_type == 'event':
                        return new EventResource($this->linkable);

                    case $this->linkable_type == 'group':
                        return new GroupResource($this->linkable);

                    case $this->linkable_type == 'mealplan':
                        return new MealplanResource($this->linkable);

                    case $this->linkable_type == 'workout':
                        return new WorkoutResource($this->linkable);
                }
            }),
            'images' => ImageResource::collection($this->images),
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
            'likes' => count($this->likes),
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
