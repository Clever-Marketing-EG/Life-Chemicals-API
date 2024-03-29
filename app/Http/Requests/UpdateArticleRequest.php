<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => ['min:3', 'string'],
            'title_ar' => ['min:3', 'string'],
            'content' => [ 'min:3', 'string'],
            'content_ar' => [ 'min:3', 'string'],
            'image_url' => ['url']
        ];
    }
}
