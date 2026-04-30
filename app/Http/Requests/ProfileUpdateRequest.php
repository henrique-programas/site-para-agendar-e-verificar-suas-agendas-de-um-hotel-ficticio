<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidCpf;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $digits = static function (?string $v): string {
            return preg_replace('/\D/', '', (string) ($v ?? ''));
        };

        $phone = $digits($this->input('phone'));
        $cpfRaw = $digits($this->input('cpf'));
        $cep = $digits($this->input('cep'));

        $this->merge([
            'phone' => $phone !== '' ? $phone : null,
            'cpf'   => $cpfRaw !== '' ? $cpfRaw : null,
            'cep'   => $cep !== '' ? $cep : null,
            'gender'        => $this->input('gender') ?: null,
            'birth_date'    => $this->input('birth_date') ?: null,
            'address_state' => $this->input('address_state') ? strtoupper((string) $this->input('address_state')) : null,
        ]);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'phone' => ['nullable', 'string', 'max:15'],
            'cpf'   => [
                'nullable',
                'string',
                'size:11',
                Rule::unique('users', 'cpf')->ignore($this->user()->id),
                new ValidCpf,
            ],

            'birth_date' => ['nullable', 'date', 'before:today'],
            'gender'     => ['nullable', 'string', Rule::in(['M', 'F', 'O', 'N'])],

            'address_street'       => ['nullable', 'string', 'max:120'],
            'address_number'       => ['nullable', 'string', 'max:15'],
            'address_complement'   => ['nullable', 'string', 'max:80'],
            'address_neighborhood' => ['nullable', 'string', 'max:80'],
            'address_city'         => ['nullable', 'string', 'max:80'],
            'address_state'        => ['nullable', 'string', 'size:2'],
            'cep'                  => ['nullable', 'string', 'size:8'],
        ];
    }
}
