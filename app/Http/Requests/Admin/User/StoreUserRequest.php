<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role === Role::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],

            'role' => [
                'required',
                'string',
                Rule::in([Role::ADMIN->value, Role::STAFF->value])
            ],

            'id_cabang' => [
                'nullable',
                Rule::requiredIf(fn() => $this->input('role') === Role::STAFF->value),
                'exists:cabang,id'
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'nama' => 'nama',
            'email' => 'email',
            'password' => 'password',
            'role' => 'role',
            'id_cabang' => 'cabang',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'id_cabang.required_if' => 'Cabang wajib dipilih untuk role Staff.',
        ];
    }
}
