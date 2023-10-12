<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class NewCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'min:5', 'max:50'],
        ];
    }
}
