<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = new Image();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'product_image'.time().'_'.$file->getClientOriginalName();
            $filePath = 'products/images/'. $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $image->image = 'products/tags/'. $fileName;
        }
        $image->save();
    }

    public function update(Image $image, Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $previousImagePath = $image->image;
            $currentImageFile = $request->file('image');
            $currentImageName = 'product_image'.time().'_'.$currentImageFile->getClientOriginalName();
            $currentImagePath = 'products/images/'.$currentImageName;
            Storage::disk('public')->put($currentImagePath, file_get_contents($currentImageFile));
            $data['image'] = $currentImagePath;

            $checkPreviousFileExist = Storage::disk('public')->exists($previousImagePath);
            if($checkPreviousFileExist){
                Storage::disk('public')->delete($previousImagePath);
            }

            $image->update($data);
        }
    }
}
