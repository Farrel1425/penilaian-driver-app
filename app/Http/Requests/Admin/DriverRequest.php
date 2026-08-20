<?php

namespace App\Http\Requests\Admin;

use App\Models\Branch;
use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['required', Rule::exists(Branch::class, 'id')],
            'full_name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sim_number' => ['nullable', 'string', 'max:100'],
            'sim_type' => ['nullable', 'string', 'max:50'],
            'sim_expired_at' => ['nullable', 'date'],
            'sim_photo' => ['nullable', 'string', 'max:255'],
            'join_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in([Driver::STATUS_ACTIVE, Driver::STATUS_INACTIVE])],
        ];
    }
}
