<?php

namespace App\Http\Requests\ProjectUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old' => ['required', 'integer', 'min:1'],
            'new' => ['required', 'integer', 'min:1', 'different:old'],
        ];
    }
}
