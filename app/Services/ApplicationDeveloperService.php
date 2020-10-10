<?php

namespace App\Services;

use App\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApplicationDeveloperService extends Application
{
     public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
    * Obtengo las applicaciones creadas por un desarrollador.
    *
    * @return Collection Application.
    * 
    */
    public function getApplicationForDeveloper()
    {
        return $this->application->whereIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 4)->orderBy('created_at', 'desc')->get();
        })->get();
    }

    /**
    * Obtengo las categorias para el formulario de edicion de una applicacion.
    *
    * @return Model Application.
    * @param Instance $application from model Application
    */
    public function getFormForEdit($application)
    {
        return $this->application->join('categories', 'categories.id', '=', 'applications.category_id')
            ->where('applications.id', $application->id)
            ->select('applications.id', 'applications.name as nameapp', 'applications.slug', 'categories.name as namecat', 'price', 'image_src')
            ->first();
    }
    
    
    /**
    * Validacion - Upload - Create de una imagen, junto con la
    * creacion de su Aplicacion.
    *
    * @return Void no return value.
    * @param Intance $request from Request
    */

    public function createApp($request)
    {
        //Si no carga ninguna imgaen, se le asigna una por defecto.
     $data = $request->all();
     $data['image_src'] = 'images/default-image.jpg';

        if ($files = $request->file('image')) 
        {
            $fileImage = Str::random(50)  . '-' . $files->getClientOriginalName();
            $path = 'images/applications/';
            $pathWhitFile = 'images/applications/' . $fileImage;
            $count = $this->application->where('image_src', $pathWhitFile)->count();
            while ($count != 0) {
                $fileImage = Str::random(50)  . '-' . $files->getClientOriginalName();
                $count = $this->application->where('image_src', $path . $fileImage)->count();
            }
            $files->move($path, $fileImage);
            $data['image_src'] = $pathWhitFile;
        }

        $newApp = $this->application->create($data);
        $newApp->users()->attach(Auth::id(), ['application_id' => $newApp->id, 'state_id' => 4]);
    }

    /**
    * Validacion -Update de imagen, junto con la
    * actualizacion de su Aplicacion.
    *
    * @return Void no return value.
    * @param Intance $request from Request
    * @param Intance $application from Application
    */
    public function updateApp($application, $request)
    {
        $data['price'] = $request->price;
        $data['description'] = $request->description;
        $data['image_src'] = 'images/default-image.jpg';

        if ($files = $request->file('image')) 
        {
            $path = 'images/applications/';

            if (file_exists($this->application->image_src && $this->application->image_src != 'images/default-image.jpg')) 
            {
                unlink($this->application->image_src);
            }

            $fileImage = Str::random(50)  . '-' . $files->getClientOriginalName();
            $fileForUpdate =  $path . $fileImage;
            $files->move($path, $fileImage);
            $data['image_src'] = $fileForUpdate;
        }
        $application->where('id', $application->id)
            ->update([
                "price" => $data["price"],
                "description" => $data["description"],
                "image_src" =>  $data["image_src"],
            ]);
    }

    /**
    * Elimina una applicacion creada
    *
    * @return Instance Model
    * @param Model $application Intancia del modelo a eliminar.
    */
    public function deleteApplication($application)
    {
        $application->where('id', $application->id)->update(['is_online' => false]);
        return $application->users()->detach();
    }
}
