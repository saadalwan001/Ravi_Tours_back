<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    // to Display all the images
    public function index()
    {
        return Gallery::all();
    }

    //Store images
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Store image in public storage
        $imagePath = $request->file('image')->store('gallery', 'public');

        // Save in DB
        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Image Uploaded Successfully',
            'gallery' => $gallery,
        ]);
    }

    //Update A Gallery Image
    public function update(Request $request, $id)
    {
        $gallery=Gallery::findorFail($id);

        $request->validate([
            'title' => 'required|string|max:225',
            'description'=> 'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        //update title & description
        $gallery->title=$request->title;
        $gallery->description=$request->description;

        //if a new image is uploaded, delete old and store new
        if($request->hasFile('image')){
            if ($gallery->image_path && storage::disk('public')->exists($gallery->image_path)){
                storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->image_path=$request->file('image')->store('gallery', 'public');


        }

        $gallery->save();

        return response()->json([
            'message'=> 'Gallery Updated Successfully',
            'gallery'=>$gallery,
        ]);
    }


    //Delete a gallery image

    public function destroy($id)
    {
        $gallery = Gallery::findorfail($id);
        //delete image from storage
        if($gallery->image_path && storage::disk('public')->exists($gallery->image_path)){
            storage::disk('public')->delete($gallery->image_path);

        }
        $gallery->delete();

        return response()->json([
            'message'=>'Gallery Deleted Successfully',
        ]);
    }
}


