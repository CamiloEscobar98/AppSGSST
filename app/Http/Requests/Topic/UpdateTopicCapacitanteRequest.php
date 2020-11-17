<?php

namespace App\Http\Requests\Topic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicCapacitanteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == 'administrador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'capacitador' => ['required', 'exists:users,email']
        ];
    }

    public function attributes()
    {
        return [
            'capacitador' => 'Usuario capacitador'
        ];
    }
}
