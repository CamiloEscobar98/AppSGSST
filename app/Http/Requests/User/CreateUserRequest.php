<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'max:80', 'string'],
            'lastname' => ['required', 'max:80', 'string'],
            'phone' => ['required', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email'],
            'document' => ['required', 'unique:documents,document', 'max:50'],
            'document_type_id' => ['required', 'exists:document_types,type'],
            'address' => ['required', 'max:191']
        ];
    }
    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nombres',
            'lastname' => 'apellidos',
            'phone' => 'celular',
            'email' => 'correo electrónico',
            'document' => 'documento',
            'document_type_id' => 'tipo de documento',
            'address' => 'dirección de residencia'
        ];
    }
}
