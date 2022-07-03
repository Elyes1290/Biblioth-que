<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CountryResource;

use App\Models\Book;
use App\Models\Country;


class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $authors = $this->id;
        // return parent::toArray($request);
        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'city' =>$this->city,
            'birthdate' =>$this->birthdate,
            'country' => Country::find($this->country_id, 'name'),
            'books' => Book::whereHas('authors', function($q) use ($authors) {
                $q->where('author_id', $authors);
            })->get('title')
            
        ];
    }
}

    

