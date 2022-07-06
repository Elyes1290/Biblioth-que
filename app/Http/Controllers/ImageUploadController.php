<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Author;
 
 
class ImageUploadController extends Controller
{
    public function index()
    {
        return view('imageUpload');
    }
 
    public function store(Request $request)
    {
         
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
 
        ]);
 
        $name = $request->file('image')->getClientOriginalName();
 
        $path = $request->file('image')->store('app/public/images');
 
 
        $save = new Image;
 
        $save->name = $name;
        $save->path = $path;
        $save->imageable_type = Author::find(1);
        $save->imageable_id = '2';

        
        
 
        $save->save();
 
      return redirect('image-upload')->with('status', 'Youpiiii your image Has been uploaded successfully.')->with('image',$name);
 
    }
}