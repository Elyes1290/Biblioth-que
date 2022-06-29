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

            return $book;
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
