<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Models\Author;
use App\Models\Country;


class AuthorService {

    public function save(Request $request, $id = null){
        try{

            $validatorRules = [

                'name' => 'required|string|max:250',
                'city' => 'required|string|max:250',
                'birthdate' => 'required|date_format:Y-m-d',
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

        }catch(\Exception $e) {
            throw $e;
        }
    }

    public function delete($id) {

        try {

            // Create or update author.
            $author = Author::find($id);

            // Check if author.
            if (!$author) {
                throw new ApiException(
                    "No author found", 
                    404
                );
            }

            // Delete the country.
            $author->delete();

            

        }catch(\Exception $e){
            throw $e;
        }
    }
}