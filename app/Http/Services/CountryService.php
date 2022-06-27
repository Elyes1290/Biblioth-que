<?php


namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Country;


class CountryService {

    public function storeCountry($iso){
        try{

            // $validatorRules = [
            //     'iso' => 'required|string',
            //     'name' => 'required|string|max:250',
            //     'description' => 'required|string|max:250'
            //     ];
        
            //     $validator = Validator::make($request->all(),$validatorRules);
        
            //     if ($validator->fails()){
            //         throw (new ValidateException(
            //             $validator->error()
            //         ));
            //     }

        // $countries = Country::find($request->input('iso'));

        // if($iso){
        //     // $country = Country::find($iso);
        //     if (!$country){
        //         throw new ApiException(
        //             "Country not found.",
        //                 404
        //             );
        //          }
        // }
        // else{
        //     $country = new Country();
        // }

        // $country->name = $request->input('name');
        // $country->description = $request->input('description');


        // $country->save();


        }catch(\Exception $e) {
            throw $e;
        }
    }

    public function show($id){

        $country = Country::find($id);
        // if (!$country){
        //     throw new ApiException(
        //         "Country not found.",
        //             404
        //         );
        //      }
        

             return $country;

    }


    // public function update($request, $id)
    // {
    //     $countries = Country::find($request->input('iso'));
    //     die($countries);

    //     $author = Author::find($id);
    //         if (!$author){
    //             throw new ApiException(
    //                 "Author not found.",
    //                     404
    //                 );
    //              }
        // $author->name = $request->input('name');
        // $author->city = $request->input('city');
        // $author->birthdate = $request->input('birthdate');
        // $author->$countries->iso = $request->input('country_id');
        // $countries->iso = $request->input('country_id');

        // $author->save();
    // }
}