<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'id' => $this->id,
            'title' => ucwords($this->title),
            'description' => ucfirst($this->description),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'genras' => $this->genras->map( function ($genra){
                return [
                    'genra_id' => $genra->id,
                    'category' => $genra->category,
                    'genra_description' => $genra->description,
                ];
            }),
            'actors' => $this->actors->map(function($actor){
                return [
                    'actor_id' => $actor->id,
                    'name' => $actor->first_name . $actor->last_name,
                    'email' => $actor->email,
                ];
            }),
        ];
    }
}
