<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageStoreRequest;
use App\Models\Image;
use Faker\Core\File;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ImageController extends Controller
{
    public function imageStore(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        $image_path = $request->file('image')->store('image', 'public');

        $data = Image::create([
            'image' => $image_path,
        ]);

        return response($data, Response::HTTP_CREATED);
    }

    public function imageUpdate(Request $request,$id)
    {
        $image = Image::find($id);
        $uploadedImage = $image->image;
        unlink(public_path('storage'). DIRECTORY_SEPARATOR .$uploadedImage);
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        
        $image_path = $request->file('image')->store('image', 'public');
        $image->image = $image_path;
        $image->save();

        return response($image, Response::HTTP_OK);
    }

    public function images()
    {
        $image = Image::get();
        return response($image, Response::HTTP_OK);
    }

    
    public function delete($id)
    {
        $image = Image::find($id);
        $uploadedImage = $image->image;
        unlink(public_path('storage'). DIRECTORY_SEPARATOR .$uploadedImage);
        
        $image = Image::destroy($id);
        return response(["message" => "Data deleted successfully"], Response::HTTP_OK);
    }
}
