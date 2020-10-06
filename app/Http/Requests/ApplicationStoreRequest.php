<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|min:3|max:190',
            'category_id'   => 'required',
            'price'         => 'required|between:0,9999.99',
            'description'   => 'required|min:3|max:900',
            'image_src' => 'mimes:jpeg,png,jpg|max:5064',
        ];
    }

    public function messages(){
        return [
            'name.required'=> 'El nombre de la applicacion es obligatorio',
            'name.min'=> 'El nombre debe tener al menos 3 caracteres',
            'category_id.required'=> 'La categoria es obligatorio',
            'price.required'=> 'El precio es obligatorio',
            'price.between'=> 'El precio debe tener un valor mayor que 0',
            'description.required'=> 'La descripcion es obligatoria',
            'description.min'=> 'La descripcion debe tener al menos 3 caracteres',
            'image_src.min'=> 'La imagen debe ser del tipo jpeg, png o jpg',
            'image_src.max'=> 'La imagen debe tener un tamaño maximo 5MB'
        ];
    }
}
