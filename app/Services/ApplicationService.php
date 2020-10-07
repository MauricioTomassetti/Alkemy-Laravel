<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApplicationService
{

    public function storeImage($data, $application, $request)
    {
        if ($files = $request->file('image')) {
            $fileImage = Str::random(50)  . '-' . $files->getClientOriginalName();

            $path = 'images/applications/';
            $pathWhitFile = 'images/applications/' . $fileImage;
            $count = $application->where('image_src', $pathWhitFile)->count();

            //En caso de que ya exista un id unico para esa imgaen, genero uno nuevo
            while ($count != 0) {
                $fileImage = Str::random(50)  . '-' . $files->getClientOriginalName();
                $count = $application->where('image_src', $path . $fileImage)->count();
            }

            $files->move($path, $fileImage);
            $data['image_src'] = $pathWhitFile;
        } else {
            //Si no carga ninguna imgaen, se le asigna una por defecto.
            $data['image_src'] = 'images/default-image.jpg';
        }
        return $data;
    }

    public function updateImage($application, $request)
    {

        if ($files = $request->file('image')) {
            $path = 'images/applications/';

            if (file_exists($application->image_src && $application->image_src != 'images/default-image.jpg')) {
                unlink($application->image_src);
            }

            $fileImage = Str::random(50)  . '-' . $files->getClientOriginalName();

            $fileForUpdate =  $path . $fileImage;
            $files->move($path, $fileImage);

            $data['price'] = $request->price;
            $data['image_src'] = $fileForUpdate;

            return $data;
        } else {

            $data['price'] = $request->price;
            $data['image_src'] = 'images/default-image.jpg';

            return $data;
        }
    }
}
