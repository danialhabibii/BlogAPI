<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:4', 'max:30'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }
}
