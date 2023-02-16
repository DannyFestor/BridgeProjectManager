<?php

namespace App\Http\Requests\ProjectUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptions extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'settings' => json_encode($this->settings),
        ]);
    }

    public function rules(): array
    {
        return [
            'settings' => ['nullable', 'json'],
        ];
    }
}
