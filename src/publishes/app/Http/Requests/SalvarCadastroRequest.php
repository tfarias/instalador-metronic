<?php

namespace App\Http\Requests;

use App\Models\Traits\Mask;

class SalvarCadastroRequest extends Request
{
    protected function getValidatorInstance()
    {

        // // obtém o cpf do request
        // $cpf = $this->request->get('cpf');

        // // apaga o cpf com a mascara
        // $this->request->remove('cpf');

        // // adiciona o novo cpf sem mascara no request
        // $this->request->add(['cpf' => Mask::remove($cpf)]);

        return parent::getValidatorInstance();
    }

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
        $userId = $this->route('id');

        return [
            'nome' => 'required',
            'email'=> 'required|email|unique:sis_usuario,email,$userId',
        ];
    }


    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatorio',
            'email.unique' => 'Este email ja está cadastrado',

        ];
    }
}
