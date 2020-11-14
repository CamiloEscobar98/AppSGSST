<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $usuario = \App\User::where('email', $this->email)->first();
        $rules = [
            'phone' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'address' => ['required', 'string'],
        ];
        if (session('role') == 'administrador') {
            $rules['name'] = ['required', 'string', 'max:80'];
            $rules['lastname'] = ['required', 'string', 'max:80'];
            $rules['email'] = ['required', 'email', 'unique:users,email,' . $usuario->id];
            $rules['document'] = ['required', 'unique:documents,document,' . $usuario->document->id];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'nombres',
            'lastname' => 'apellidos',
            'birthday' => 'fecha de nacimiento',
            'phone' => 'celular',
            'address' => 'dirección de residencia',
            'email' => 'correo electrónico',
            'document' => 'documento'
        ];
    }
}
