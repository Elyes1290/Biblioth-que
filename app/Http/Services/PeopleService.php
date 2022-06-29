<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Models\People;
use App\Models\Country;


class PeopleService {

    public function save(Request $request, $id = null){
        try{

            $validatorRules = [

                'firstname' => 'required|string|max:250',
                'lastname' => 'required|string|max:250',
                'birthdate' => 'required|date_format:Y-m-d',
                'address' => 'required|string|max:150',
                'zip' => 'required|string|max:150',
                'city' => 'required|string|max:150',
                'phone' => 'required|string|max:150',
                'email' => 'required|string|max:150',
                'country_id' => 'required|string|exists:countries,iso'
                ];
        
                $validator = Validator::make($request->all(),$validatorRules);
        
                if ($validator->fails()){
                    throw (new ValidateException(
                        $validator->errors()
                    ));
                }

        $people = null;
// update
        if($id){
            $people = People::find($id);
            if (!$people){
                throw new ApiException(
                    "People not found.",
                        404
                    );
                 }
        }
        else{
            $people = new People();
        }

        $people->firstname = $request->input('firstname');
        $people->lastname = $request->input('lastname');
        $people->birthdate = $request->input('birthdate');
        $people->address = $request->input('address');
        $people->zip = $request->input('zip');
        $people->city = $request->input('city');
        $people->phone = $request->input('phone');
        $people->email = $request->input('email');
        $people->country_id = $request->input('country_id');




        $people->save();

        }catch(\Exception $e) {
            throw $e;
        }
    }

    public function delete($id) {

        try {

            // Create or update author.
            $people = People::find($id);

            // Check if author.
            if (!$people) {
                throw new ApiException(
                    "No people found", 
                    404
                );
            }

            // Delete the country.
            $people->delete();

            

        }catch(\Exception $e){
            throw $e;
        }
    }
}