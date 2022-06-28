<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Models\Category;


class CategoryService {
    
    public function save(Request $request, $id = null) {

        try{
            $validatorRules = [

                'name' => 'required|string|max:250',
                'description' => 'nullable|string|'
                ];
        
                $validator = Validator::make($request->all(),$validatorRules);
        
                if ($validator->fails()){
                    throw (new ValidateException(
                        $validator->errors()
                    ));
                }
    
        $category = null;
    
        // update
                
                if($id){
                    $category = Category::find($id);
                    if(!$category){
                        throw new ApiException(
                            "Category not found.",
                            404
                        );
    
                    }
                }
                else{
                    $category = new Category();
                }

                $category->name = $request->input('name');
                $category->description = $request->input('description');

                $category->save();

        }catch(\Exception $e){
            throw $e;
        }

    }


    public function delete($id){
        try{


            $category = Category::find($id);

            if(!$category){
                throw new ApiException(
                    "Category not found.",
                    404
                );
            }

            $category->delete();

        }catch(\Exception $e){
            throw $e;
        }
    }






}
