<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Models\Author;
use App\Models\People;
use App\Models\Country;
use App\Http\Resource\CountryResource;
use App\Http\Services\CountryService;
use App\Http\Resources\CountryCollection;

class CountryController extends Controller
{

    public function __construct(private CountryService $_countryservice){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return new CountryCollection($countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $iso)
    {
        try {
        
            $country =  $this->_countryservice->save($request, $iso);
            return new CountryResource($country);
    
        }catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iso)
    {
        try {

            $country = Country::find($iso);
            if (!$country){
                throw new ApiException(
                    "Country not found.",
                        404
                    );
                 }
            return $country;
        
    
        }catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($iso)
    {
        $isDeleted = $this->_countryservice->delete($iso);
        if($isDeleted) {
            return response([
                'success' => true,
                'message' => "Your country has been deleted successfully"
            ], 200);
        } else {
        throw new ApiException("Cannot delete Country.");
        }
    }
}
