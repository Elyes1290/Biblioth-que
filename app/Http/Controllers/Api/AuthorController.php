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
use App\Http\Services\AuthorService;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;


class AuthorController extends Controller
{
    public function __construct(private AuthorService $_authorservice){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();

        return new AuthorCollection($authors);


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

        $authors = $this->_authorservice->save($request, null);
        return response([
            'success' => true,
            'message' => 'Author created successfully'
        ], 200);

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
        try {
            $author = $this->_authorservice->save($request,$id);
            return response([
                'success' => true,
                'message' => 'Author successfully updated.'
            ], 200);

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
        $isDeleted = $this->_authorservice->delete($id);
        if(!$isDeleted) {
            return response([
                'success' => true,
                'message' => "Your author has been deleted successfully"
            ], 200);
        } else {
        throw new ApiException("Cannot delete Author.");
        }
    }
}
