<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
       public function rules(): array
    {
        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias', 'nome')->ignore($this->route('categoria'))
            ],
            'descricao' => ['required', 'string','max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'nome.unique' => 'O nome da categoria já existe',
            'icone.required' => 'O campo icone é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.string' => 'O campo descrição deve ser uma string',
            'descricao.max' => 'O campo descrição deve ter no máximo 1000 caracteres',
        ];
    }
}
