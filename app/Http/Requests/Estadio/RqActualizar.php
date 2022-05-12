<?php

namespace ioliga\Http\Requests\Estadio;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizar extends FormRequest
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

        return [
            'nombre'=>'required|unique:estadio,nombre,'.$this->input('estadio'),
            'direccion'=>'required',
            'telefono'=>'nullable|digits_between:6,10',
        ];
    }
}
