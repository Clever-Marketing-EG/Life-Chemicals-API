<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'string', 'unique:articles'],
            'title_ar' => ['required', 'min:3', 'string', 'unique:articles'],
            'content' => ['required', 'min:3', 'string'],
            'content_ar' => ['required', 'min:3', 'string'],
            'image_url' => ['required', 'url']
        ];
    }
}
