<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $newsId = $this->route('news')->id; // Lấy id của tin tức đang được cập nhật

        return [
            // Đảm bảo title là duy nhất, nhưng bỏ qua (ignore) chính tin tức này
            'title' => ['required', 'string', 'max:255', Rule::unique('news', 'title')->ignore($newsId)],
            'content' => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}