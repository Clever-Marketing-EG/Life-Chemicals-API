<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'name' => ['min:3', 'string', 'unique:categories'],
            'name_ar' => ['min:3', 'string', 'unique:categories'],
            'description' => [ 'min:3', 'string'],
            'description_ar' => [ 'min:3', 'string'],
            'image_url' => ['url']
        ];
    }
}
