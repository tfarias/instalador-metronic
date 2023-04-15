<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{

    /**
     * Get the response for a forbidden operation.
     *
     * @return \Illuminate\Http\Response
     */
    public function forbiddenResponse()
    {
        flash('Você não tem permissão para acessar a página solicitada.', 'danger');

        return $this->redirector->back();
    }

    /**
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        $response = [];
        foreach ($validator->errors()->all() as $error) {
            flash($error, 'danger');
            if ($this->ajax()) {
                $response[] = $error;
            }
        }

        return $response;
    }
}