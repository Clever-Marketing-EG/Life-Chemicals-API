<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'string', 'categories'],
            'name_ar' => ['required', 'min:3', 'string', 'categories'],
            'description' => ['required', 'min:3', 'string'],
            'description_ar' => ['required', 'min:3', 'string'],
            'image_url' => ['required', 'url']
        ];
    }
}
