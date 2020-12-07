<?php

namespace App\Http\Requests\Word;

use Illuminate\Foundation\Http\FormRequest;

class CreateWordRequest extends FormRequest
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
            'game' => ['required', 'exists:games,id'],
            'word' => ['required'],
            'clue' => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'game' => 'juego',
            'word' => 'palabra',
            'clue' => 'pista de palabra'
        ];
    }
}
