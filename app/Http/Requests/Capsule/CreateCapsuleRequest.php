<?php

namespace App\Http\Requests\Capsule;

use Illuminate\Foundation\Http\FormRequest;

class CreateCapsuleRequest extends FormRequest
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
            'topic' => ['required', 'exists:topics,id'],
            'title' => ['required', 'string', 'unique:capsules,title', 'max:80'],
            'info' => ['required', 'string'],
            'video' => ['required', 'url', 'unique:capsules,video']
        ];
    }

    public function attributes()
    {
        return [
            'topic' => 'temática',
            'title' => 'titulo de la cápsula',
            'info' => 'descripción de la cápsula',
            'video' => 'video de la cápsula',
        ];
    }
}
