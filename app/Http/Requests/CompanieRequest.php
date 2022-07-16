<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanieRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'latitude' => 'required|min:3|max:45',
		    'longitude' => 'required|min:3|max:45',
		    'phone' => 'required|min:3|max:45',
		    'social_link' => 'required|min:3|max:45'
        ];
    }

    /**
     * Get the messages apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'Nome deve ser preenchido.',
            'latitude.required' => 'Latitude deve ser preenchido.',
		    'longitude.required' => 'Longitude deve ser preenchido.',
		    'phone.required' => 'Telefone deve ser preenchido.',
		    'social_link.required' => 'Rede social deve ser preenchido.',

            'name.min' => 'Preencha no mínimo 3 caracteres',
            'latitude.min' => 'Preencha no mínimo 3 caracteres',
		    'longitude.min' => 'Preencha no mínimo 3 caracteres',
		    'phone.min' => 'Preencha no mínimo 3 caracteres',
		    'social_link.min' => 'Preencha no mínimo 3 caracteres',

            'name.max' => 'Preencha no máximo 100 caracteres',
            'latitude.max' => 'Preencha no máximo 45 caracteres',
		    'longitude.max' => 'Preencha no máximo 45 caracteres',
		    'phone.max' => 'Preencha no máximo 45 caracteres',
		    'social_link.max' => 'Preencha no máximo 45 caracteres'
        ];
    }
}
