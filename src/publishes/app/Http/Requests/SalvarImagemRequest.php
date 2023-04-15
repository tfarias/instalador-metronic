<?php

namespace App\Http\Requests;

class SalvarImagemRequest extends Request
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
                'photo'=> 'required|image|mimes:jpeg,bmp,png|max:2000'
             ];
    }


    public function messages()
    {
         return [
                 'photo.image' => 'O formato das imagens deve ser jpeg,bmp ou png!',
                 'photo.max' => 'O tamanho máximo da imagem deve ser 2000 KB!',
                 'photo.required' => 'A imagem é obrigatória ',
             ];
    }
}
