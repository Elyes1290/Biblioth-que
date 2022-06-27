<?php


namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Country;


class CountryService {

    public function save(Request $request, $id = null){
        try{

            $validatorRules = [
                'iso' => 'required|string|max:3',
                'name' => 'required|string|max:50',
                'description' => 'nullable|string'
                ];
        
                $validator = Validator::make($request->all(),$validatorRules);
        
                if ($validator->fails()){
                    throw (new ValidateException(
                        $validator->errors()
                    ));
                }

        // $countries = Country::find($request->input('iso'));

        if($id){
            $country = Country::find($id);
            if (!$country){
                throw new ApiException(
                    "Country not found.",
                        404
                    );
                 }
        }
        else{
            $country = new Country();
        }

        if(!$id){
            $countryFound = Country::where('iso', $country->iso)->first();

            if($countryFound){
                throw new ApiException("Cannot create country, because a same contry already exists");
            }
        }


        $country->name = $request->input('name');
        $country->description = $request->input('description');


        $country->save();

        return $country;


        }catch(\Exception $e) {
            throw $e;
        }
    }

  

    public function delete($id) {

        try {

                $country = Country::find($id);
                if (!$country){
                    throw new ApiException(
                        "Country not found.",
                            404
                        );
                     
            }


            $countryAuthorFound = Author::where('country_id', $country->iso)->first();

            

        }catch(\Exception $e){
            throw $e;
        }

    }


    
}