<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'scheduling_date' => 'required',
            'user_id' => 'required',
		    'employee_id' => 'required',
            'confirmado' => 'required',
            'observacao' => 'required',
            'horario' => 'required',
            'servicos' => 'required'

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
            'scheduling_date.required' => 'Data e Hora do agendamento deve ser preenchido.',
            'user_id.required' => 'Cliente deve ser preenchido.',
		    'employee_id.required' => 'Funcionário deve ser preenchido.',
            'confirmado.required' => 'Confirmado deve ser preenchido.',
            'observacao.required' => 'Observação deve ser preenchido.',
            'horario.required' => 'Horário deve ser preenchido.',
            'servicos.required' => 'Serviços deve ser preenchido.',
        ];
    }
}
