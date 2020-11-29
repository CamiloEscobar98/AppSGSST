<?php

namespace App\Http\Requests\Topic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == 'administrador' || session('role') == 'capacitador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic' => ['required', 'exists:topics,id'],
            'title' => ['required', 'string', 'unique:topics,title,' . $this->topic, 'max:80'],
            'info' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titulo de la temática',
            'info' => 'descripción de la temática',
        ];
    }
}
