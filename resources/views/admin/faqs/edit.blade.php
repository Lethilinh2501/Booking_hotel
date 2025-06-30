@extends('layout.admin')


@section('content')
    <main class="lh-main-content">

<div class="container mt-4">
    <h2>Chỉnh sửa câu hỏi thường gặp</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question" class="form-label">Câu hỏi</label>
            <input type="text" name="question" id="question" class="form-control"
                   value="{{ old('question', $faq->question) }}" required>
        </div>

        <div class="mb-3">
            <label for="answer" class="form-label">Câu trả lời</label>
            <textarea name="answer" id="answer" class="form-control" rows="4" required>{{ old('answer', $faq->answer) }}</textarea>
        </div>

<div class="mb-3">
    <label for="is_active" class="form-label">Hiển thị?</label>
    <select name="is_active" id="is_active" class="form-select" required>
        <option value="1" {{ old('is_active', $faq->is_active) == '1' ? 'selected' : '' }}>Có</option>
        <option value="0" {{ old('is_active', $faq->is_active) == '0' ? 'selected' : '' }}>Không</option>
    </select>
</div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
