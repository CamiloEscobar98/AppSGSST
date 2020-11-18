<?php

namespace App\Http\Requests\Capsule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCapsuleRequest extends FormRequest
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
            'capsule' => ['required', 'exists:capsules,id'],
            'title' => ['required', 'string', 'unique:topics,title,' . $this->capsule, 'max:80'],
            'info' => ['required', 'string'],
            'video' => ['required', 'url']
        ];
    }

    public function attributes()
    {
        return [
            'capsule' => 'cápsula',
            'title' => 'titulo de la cápsula',
            'info' => 'descripción de la cápsula',
            'video' => 'video de la cápsula',
        ];
    }
}
