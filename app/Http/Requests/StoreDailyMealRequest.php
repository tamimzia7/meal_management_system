<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyMealRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'meal_date' => ['required', 'date'],
            'breakfast_meal' => ['required', 'integer', 'min:0'],
            'lunch_meal' => ['required', 'integer', 'min:0'],
            'dinner_meal' => ['required', 'integer', 'min:0'],
            'remarks' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Please select a company.',
            'company_id.exists' => 'The selected company does not exist.',
            'breakfast_meal.required' => 'Please enter breakfast count.',
            'lunch_meal.required' => 'Please enter lunch count.',
            'dinner_meal.required' => 'Please enter dinner count.',
        ];
    }
}
