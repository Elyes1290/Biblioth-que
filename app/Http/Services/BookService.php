<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Models\Author;
use App\Models\Book;


class BookService {

    public function save(Request $request, $isbn = null){
        try{

            $validatorRules = [

                'title' => 'required|string|max:3',
                'year' => 'required|date_format:Y',
                'summary' => 'required|string',
                'etat' => 'in:good,durty',
                'statut' => 'in:available,loan',
                'category_id' => 'required|integer|exists:categories,id'
                ];
        
                $validator = Validator::make($request->all(),$validatorRules);
        
                if ($validator->fails()){
                    throw (new ValidateException(
                        $validator->errors()
                    ));
                }

        $book = null;

        if($isbn){
            $book = Book::find($isbn);
            if(!$book){
                throw new ApiException(
                    "Book not found",
                    404
                );
            }
        }

        
        

        $book->title = $request->input('title');
        $book->year = $request->input('year');
        $book->summary = $request->input('summary');
        $book->etat = $request->input('etat');
        $book->statut = $request->input('statut');
        $book->category_id = $request->input('category_id');

        $book->save();

        }catch(\Exception $e){
            throw $e;
        }
    }


    public function delete($isbn){

        try{

            $book = Book::find($isbn);

            if(!$book){
                throw new ApiException(
                    "Book not found",
                    404
                );
            }


            $book->delete();

        }catch(\Exception $e){
            throw $e;
        }
    }
}