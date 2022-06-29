<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Models\People;
use App\Models\Country;
use App\Http\Resources\PeopleResource;
use App\Http\Services\PeopleService;
use App\Http\Resources\PeopleCollection;

class PeopleController extends Controller
{

    public function __construct(private PeopleService $_peopleservice){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::all();

        return new PeopleCollection($people);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $people = $this->_peopleservice->save($request, null);
            return response([
                'success' => true,
                'message' => 'People successfully created.'
            ],200);
        }catch(Exception $e){
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

            $people = People::find($id);
            if (!$people){
                throw new ApiException(
                    "People not found.",
                        404
                    );
                 }
            return $people;
        
    
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
        try{
            $people = $this->_peopleservice->save($request, $id);
            return response([
                'success' => true,
                'message' => 'People successfully updated.'
            ],200);
        }catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $isDeleted = $this->_peopleservice->delete($id);
            if(!$isDeleted) {
                return response([
                    'success' => true,
                    'message' => 'The person specified was deleted.'
                ], 200);
            }
        }catch(\Exception $e) {
            throw $e;
        }
    }
}
