<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:100'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'kind'        => ['required', 'string', 'max:50'],
            'weight'      => ['required', 'numeric', 'min:0.1', 'max:9999'],
            'age'         => ['required', 'integer', 'min:0', 'max:100'],
            'bread'       => ['required', 'string', 'max:100'],
            'location'    => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:1000'],
            'active'      => ['nullable', 'boolean'],
            'adopted'     => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom attribute names for error messages.
     */
    public function attributes(): array
    {
        return [
            'name'        => 'nombre',
            'image'       => 'imagen',
            'kind'        => 'tipo de animal',
            'weight'      => 'peso',
            'age'         => 'edad',
            'bread'       => 'raza',
            'location'    => 'ubicación',
            'description' => 'descripción',
            'active'      => 'estado activo',
            'adopted'     => 'adoptado',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'El nombre de la mascota es obligatorio.',
            'kind.required'        => 'El tipo de animal es obligatorio.',
            'weight.required'      => 'El peso es obligatorio.',
            'weight.numeric'       => 'El peso debe ser un número.',
            'age.required'         => 'La edad es obligatoria.',
            'age.integer'          => 'La edad debe ser un número entero.',
            'bread.required'       => 'La raza es obligatoria.',
            'location.required'    => 'La ubicación es obligatoria.',
            'description.required' => 'La descripción es obligatoria.',
            'image.image'          => 'El archivo debe ser una imagen.',
            'image.max'            => 'La imagen no puede superar 2MB.',
        ];
    }
}