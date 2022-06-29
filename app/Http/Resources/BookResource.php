<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use App\Models\Author;
use App\Http\Resources\CategoryCollection;


class BookResource extends JsonResource
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

            'isbn' =>$this->isbn,
            'title' =>$this->title,
            'summary' =>$this->summary,
            'etat' =>$this->etat,
            'statut' =>$this->statut,
            'categories' => Category::find($this->category_id, 'name'),
            'authors' => Author::with('books')->get()
        ];
    }
}
