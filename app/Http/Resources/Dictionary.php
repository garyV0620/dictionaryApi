<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dictionary extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //format all the datas from the DB (if you define relationship you can access it also here)
        return [
            'id' => $this->id,
            'word' => ucwords($this->word),
            'meaning' => ucfirst($this->meaning),
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
            
            //relationship on the author (authors information)
            'authors' => $this->authors->map(function($author){
                return [
                    'author_id' => $author->id,
                    'author_name' => $author->name,
                    'email' => $author->email,
                ];
            }),
        ];
    }
}
