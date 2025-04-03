<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class MainRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {

        $errors = $validator->errors()->toArray();
        $formattedErrors = $this->getFormattedErrors($errors);

        if ($this->expectsJson() || $this->isJson()) {
            throw new ValidationException($validator, response()->json(['errors' => $formattedErrors], 400));
        }

        parent::failedValidation($validator);
    }

    protected function getFormattedErrors(array $errors): array
    {
        $formattedErrors = [];

        foreach ($errors as $field => $messages) {
            $nestedFields = explode('.', $field);
            $currentArray = &$formattedErrors;

            foreach ($nestedFields as $nestedField) {
                $currentArray = &$currentArray[$nestedField];
            }
            $currentArray = $messages;
        }

        return $formattedErrors;
    }
}
