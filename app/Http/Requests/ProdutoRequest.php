<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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

    public function prepareForValidation()
    {

        if ($this->has('valor')) {
            $this->merge([
                'valor' => str_replace(',', '.', str_replace('.', '', $this->valor))
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'foto' => $this->isMethod('post') ? ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'] : ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'valor' => ['required', 'numeric'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'quantidade' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'foto.required' => 'O campo foto é obrigatório',
            'foto.image' => 'O campo foto deve ser uma imagem',
            'foto.mimes' => 'O campo foto deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg',
            'foto.max' => 'O campo foto deve ter no máximo 2048 bytes',
            'valor.required' => 'O campo valor é obrigatório',
            'valor.numeric' => 'O campo valor deve ser um número',
            'categoria_id.required' => 'O campo categoria é obrigatório',
            'categoria_id.exists' => 'A categoria informada não existe',
            'quantidade.required' => 'O campo quantidade é obrigatório',
            'quantidade.numeric' => 'O campo quantidade deve ser um número',
        ];
    }
}
