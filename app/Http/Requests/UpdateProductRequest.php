<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['min:3', 'string', 'unique:products'],
            'name_ar' => ['min:3', 'string', 'unique:products'],
            'description' => ['string'],
            'description_ar' => ['string'],
            'uses' => ['string'],
            'uses_ar' => ['string'],
            'origins' => ['array', 'min:1'],
            'origins.*' => ['string', 'distinct', 'min:3'],
            'origins_ar' => ['array', 'min:1'],
            'origins_ar.*' => ['string', 'distinct', 'min:3'],
            'image_url' => ['url'],
            'weight' => ['min:0', 'integer'],
            // 'categories' => ['array', 'min:1'],
            // 'categories.*' => ['required','integer', 'min:1']
        ];
    }
}
