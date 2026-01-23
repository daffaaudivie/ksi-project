<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->role === Role::ADMIN;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user'))
            ],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => ['required', 'string', Rule::in([Role::STAFF, Role::ADMIN])],
            'id_cabang' => [
                'nullable',
                Rule::requiredIf(fn() => $this->input('role') === Role::STAFF),
                'exists:cabang,id'
            ],
        ];
    }

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
