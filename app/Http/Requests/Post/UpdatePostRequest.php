<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['integer'],
            'status' => ['string', 'max:30'],
            'title' => ['string', 'min:4', 'max:30'],
            'description' => ['string', 'min:10', 'max:500'],
        ];
    }
}
