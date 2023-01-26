<?php

namespace App\Http\Requests\ProjectUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIsManagerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_manager' => ['required', 'boolean'],
        ];
    }
}
