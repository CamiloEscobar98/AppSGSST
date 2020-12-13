<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
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
            'title' => ['required', 'unique:games,title,' . $this->game],
        ];
    }
    public function attributes()
    {
        return [
            'game' => 'juego',
            'title' => 'título del juego',
        ];
    }
}
