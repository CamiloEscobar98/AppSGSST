<?php

namespace App\Http\Requests\Topic;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopicRequest extends FormRequest
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
            'title' => ['required', 'string', 'unique:topics,title', 'max:80'],
            'info' => ['required', 'string'],
            'capacitador' => ['required', 'exists:users,email']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titulo de la temática',
            'info' => 'descripción de la temática',
            'capacitador' => 'usuario capacitador'
        ];
    }
}
