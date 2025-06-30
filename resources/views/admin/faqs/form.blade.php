@php
    $isEdit = isset($faq) && $faq !== null;
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label for="question" class="form-label">Câu hỏi</label>
    <input type="text" name="question" class="form-control" id="question"
           value="{{ old('question', $faq->question ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="answer" class="form-label">Câu trả lời</label>
    <textarea name="answer" class="form-control" id="answer" rows="4" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Trạng thái</label>
    <select name="status" class="form-select" id="status" required>
        <option value="active" {{ old('status', $faq->status ?? '') == 'active' ? 'selected' : '' }}>Hiển thị</option>
        <option value="inactive" {{ old('status', $faq->status ?? '') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">Lưu</button>
<a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Quay lại</a>

</form>