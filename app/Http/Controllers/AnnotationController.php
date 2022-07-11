<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Image;
use Image;  //  ok
use Illuminate\Support\Str;

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
            // redimensiona imagem.
            // $nameFile = Str::kebab($request->file('image')->getClientOriginalName());
            // $data['image'] = $nameFile;
            // // var_dump($nameFile);
            // $image = Image::make($request->image)
            //                 ->orientate()
            //                 ->resize(150,null, function($c){
            //                     $c->aspectRatio();
            //                     $c->upsize();
            //                 })
            //                 ->resizeCanvas(170,170);
                            // dd($image);
                            // var_dump($nameFile);
            // return $image->response('jpg', 100);
            // final do redimensionamento.
            $image = base64_encode(file_get_contents($request->file('image')));
            // $image = base64_encode(file_get_contents($image));
            //prepare request
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request],  env('GOOGLE_CLOUD_KEY'));
            //send annotation request
            $response = $gcvRequest->annotate();
            // return json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);
            $array = (array) $response->responses[0]->textAnnotations[0]->description;
            foreach ($array as $key => $value) {
                $words = explode("\n", $value);
                // dd($words); //  array
                $jogo = $words[0];
                $entrada = (integer) $words[17];
                $saida = (integer) $words[20];
                echo "Jogo: " . $jogo . "<br>";
                echo "Entrada: " . $entrada . "<br>";
                echo "Saida: " . $saida . "<br>";
            }


        }
    }
}
