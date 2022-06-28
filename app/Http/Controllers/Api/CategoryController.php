<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Http\Services\CategoryService;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $_categoryservice){}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return new CategoryCollection($categories);
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
            $categories = $this->_categoryservice->save($request, null);
        return response([
            'success' => true,
            'message' => 'Category successfully created.'
        ], 200);
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
    public function show($id)
    {
        try{
            $category = Category::find($id);
        if(!$category){
            throw new ApiException(
                "Category not found.",
                404);
        }
        return $category;
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
            $categroy = $this->_categoryservice->save($request,$id);
            return response([
                'success' => true,
                'message' => 'Category successfully updated.'
            ], 200);
        }catch(\Exception $e){
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
            $isDeleted = $this->_categoryservice->delete($id);
        if(!$isDeleted) {
            return response([
                'success' => true,
                'message' => "Your country has been deleted successfully"
            ], 200);
        } else {
        throw new ApiException("Cannot delete Category.");
        }
    }catch(Exception $e){
            throw $e;
        } 
    }
}
