<?php

namespace App\Http\Requests\Admin\Cabang;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\JenisBisnis;
use Illuminate\Validation\Rule;

class StoreCabangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nama_cabang'  => ['required', 'string', 'max:200'],
            'jenis_bisnis' => ['required', Rule::enum(JenisBisnis::class)],
            'alamat'       => ['required', 'string'],
            'telepon'      => ['required', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'is_active'    => ['sometimes', 'boolean'],
            'id_provinsi' => 'required|string|max:10',
            'nama_provinsi' => 'required|string|max:100',
            'id_kota' => 'required|string|max:10',
            'nama_kota' => 'required|string|max:100',
        ];
    }

    public function validatedData(): array
    {
        return array_merge(
            $this->validated(),
            ['is_active' => $this->boolean('is_active')]
        );
    }
}
