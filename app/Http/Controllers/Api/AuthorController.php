<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Country;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    try {
        $validatorRules = [

        'name' => 'required|string|max:50',
        'city' => 'required|string|max:20',
        'birthdate' => 'required|date_format:Y/m/d',
        'country_id' => 'required|digits_between:1,20|required|'
        ];

        $validator = Validator::make($request->all(),$validatorRules);

        if ($validator->fails()){
            throw (new ValidateException(
                $validator->error()
            ));
        }

        $countries = Country::find($request->input('iso'));

        $author = new Author();
        $author->name = $request->input('name');
        $author->city = $request->input('city');
        $author->birthdate = $request->input('birthdate');
        $author->country_id = $country->iso;

        $author->save();

        return $author;

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
    public function show($id)
    {
        try {
            $author = Author::find($id);
            if (!$author){
                throw new ApiException(
                    "Author not found.",
                    404
                );
            }
            return $author;
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
        $country = Country::find($request->input('country_id'));

        $author = Author::find($id);
        $author->name = $request->input('name');
        $author->city = $request->input('city');
        $author->birthdate = $request->input('birthdate');
        $author->country_id = $country->iso;

        $author->save();

        return $author;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        return 'Film has been deleted successfully';
    }
}
