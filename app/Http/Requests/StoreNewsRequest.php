<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép mọi người dùng đã được xác thực có thể thực hiện request này
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:news,title', // Đảm bảo title là duy nhất trong bảng news
            'content' => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}