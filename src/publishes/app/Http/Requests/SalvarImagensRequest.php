<?php

namespace App\Http\Requests;

class SalvarImagensRequest extends Request
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
        $rules = [
            'legenda' => 'nullable',
            'assinatura_id' => 'required|integer|exists:assinaturas,id',
            'deleted_at' => 'nullable',
        ];
        $photos = count($this->input('caminho'));
        foreach(range(0, $photos) as $index) {
            $rules['caminho.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
        }

        return $rules;
    }


    public function messages()
    {
         return [
                'caminho.image' => 'O formato das imagens deve ser jpeg,bmp ou png!',
                'caminho.max' => 'O tamanho máximo da imagem deve ser 2000 KB!',
                'assinatura_id.required' => 'Assinatura é obrigatório',
                'assinatura_id.integer' => 'Assinatura inválido',
                'assinatura_id.exists' => 'Assinatura não exite na Base de Dados',
             ];
    }
}
