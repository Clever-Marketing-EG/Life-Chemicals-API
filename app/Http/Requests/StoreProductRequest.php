<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'string'],
            'name_ar' => ['required', 'min:3', 'string'],
            'description' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'uses' => ['required', 'string'],
            'uses_ar' => ['required', 'string'],
            'origins' => ['required', 'array', 'min:1'],
            'origins.*' => ['required', 'string', 'distinct', 'min:3'],
            'origins_ar' => ['required', 'array', 'min:1'],
            'origins_ar.*' => ['required', 'string', 'distinct', 'min:3'],
            'image_url' => ['required', 'url'],
            'weight' => ['required', 'min:0', 'integer'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'integer', 'min:1', 'exists:categories,id']
        ];
    }
}
