<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Http\Services\BookService;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;

class BookController extends Controller
{

    public function __construct(private BookService $_bookservice){}
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/api/books/",
     *   tags={"Books"},
     *   summary="Get a list of books",
     *   operationId="Index Book",
     *
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index()
    {
        $books = Book::all();

        return new BookCollection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     ** path="/api/books/",
     *   tags={"Books"},
     *   summary="add books",
     *   operationId="Store Book",
     *
     *  @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="year",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="summary",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="etat",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string",
     *           enum={"good", "durty"}
     *      ),
     *   ),
     * 
     * @OA\Parameter(
     *      name="statut",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string",
     *           enum={"available", "loan"}
     *      )
     *   ),
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(Request $request)
    {
        try{

            $books = $this->_bookservice->save($request, null);
            return response([
                'success' => true,
                'message' => 'Book saved successfully.'
                
            ],200);

        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     ** path="/api/books/{isbn}",
     *   tags={"Books"},
     *   summary="show a books",
     *   operationId="show Book",
     *
     *   @OA\Parameter(
     *      name="isbn",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function show($isbn)
    {
        try{
            $book = Book::find($isbn);
            if(!$book){
                throw new ApiException(
                    'Book does not exist',
                    404
                );
            }

            return new BookResource($book);

        }catch(\Exception $e){
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

     /**
     * @OA\Put(
     ** path="/api/books/{isbn}",
     *   tags={"Books"},
     *   summary="update of books",
     *   operationId="update Book",
     *
     *   @OA\Parameter(
     *      name="isbn",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="year",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="summary",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function update(Request $request, $id)
    {
        try{

            $books = $this->_bookservice->save($request, $id);
            return response([
                'success' => true,
                'message' => 'Book saved successfully.'
            ],200);

        }catch(\Exception $e){
            throw $e;
        }//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/api/books/{isbn}",
     *   tags={"Books"},
     *   summary="Delete books",
     *   operationId="Destroy Book",
     *
     *   @OA\Parameter(
     *      name="isbn",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function destroy($id)
    {
        $isDeleted = $this->_bookservice->delete($id);
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
