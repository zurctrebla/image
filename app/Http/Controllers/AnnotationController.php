<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;
//use Intervention\Image\Image;
use Image;  //  ok

class AnnotationController extends Controller
{
    //show the upload form
    public function displayForm()
    {
        return view('annotate');
    }

    public function annotateImage(Request $request)
    {
        if($request->file('image')){

            $image = Image::make($request->file('image'))->encode('jpg', 100);

            //return $request->file('image');   //  ok

            // $image->resize(320,320);

            return $image->response();  //  ok

        }
    }
}
