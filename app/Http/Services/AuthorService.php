<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Models\Author;
use App\Models\Country;


class AuthorService {

    public function storeAuthor(Request $request, $id = null){
        try{

            $validatorRules = [

                'name' => 'required|string|max:250',
                'city' => 'required|string|max:250',
                'birthdate' => 'required|date_format:Y/m/d',
                'country_id' => 'required|string|max:3'
                ];
        
                $validator = Validator::make($request->all(),$validatorRules);
        
                if ($validator->fails()){
                    throw (new ValidateException(
                        $validator->errors()
                    ));
                }

        $author = null;
// update
        if($id){
            $author = Author::find($id);
            if (!$author){
                throw new ApiException(
                    "Author not found.",
                        404
                    );
                 }
        }
        else{
            $author = new Author();
        }

        $author->name = $request->input('name');
        $author->city = $request->input('city');
        $author->birthdate = $request->input('birthdate');
        $author->country_id = $request->input('country_id');

        $author->save();

        if($request and $id)
        {
            return "L'auteur à bien été mis à jour";
        }

        else if($request)
        {
            return "L'auteur à bien été ajouté";
        }

        }catch(\Exception $e) {
            throw $e;
        }
    }

    public function show($id){

        $author = Author::find($id);
        if (!$author){
            throw new ApiException(
                "Author not found.",
                    404
                );
             }
        

             return $author;

    }


    public function update(Request $request, $id)
    {

        $validatorRules = [
            'name' => 'required|string|max:250',
            'city' => 'required|string|max:250',
            'birthdate' => 'required|date_format:Y/m/d',
        ];

        $validator = Validator::make($request->all(),$validatorRules);

        if ($validator->fails()){
            throw (new ValidateException(
                $validator->errors()
            ));
        }

        
        // $countries = Country::find($request->input('iso'));
        // die($countries);

        $author = Author::find($id);
            if (!$author){
                throw new ApiException(
                    "Author not found.",
                        404
                    );
                 }
        $author->name = $request->input('name');
        $author->city = $request->input('city');
        $author->birthdate = $request->input('birthdate');
        // $author->$countries->iso = $request->input('country_id');
        $author->country_id = $request->input('country_id');

        $author->save();

    }
}