<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Дозволяє всім авторизованим користувачам використовувати цей запит
    }

    public function rules()
    {
        return [
            'description' => 'required|string|max:255',
        ];
    }
}