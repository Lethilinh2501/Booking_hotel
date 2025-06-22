@extends('layout.admin')

@section('content')
    <div class="container">
        <h1>Thêm Nội Quy</h1>
        <form action="{{ route('admin.rules.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection
