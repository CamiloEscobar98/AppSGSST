<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class CreateGameRequest extends FormRequest
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
            'title_game' => ['required', 'unique:games,title'],
            'game_type' => ['required', 'integer', 'max:3', 'min:1']
        ];
    }
    public function messages()
    {
        return [
            'game_type.max' => 'Error, tipo de juego no disponible',
            'game_type.min' => 'Error, tipo de juego no disponible'
        ];
    }
    public function attributes()
    {
        return [
            'topic' => 'temática',
            'title_game' => 'título del juego',
            'game_type' => 'tipo de juego'
        ];
    }
}
