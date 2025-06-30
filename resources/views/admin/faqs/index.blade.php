@extends('layout.admin')

@section('content')
<main class="lh-main-content">

    <div class="d-flex justify-content-between mb-3">
        <h3>Danh sách Câu hỏi thường gặp (FAQ)</h3>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Thêm câu hỏi</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Câu hỏi</th>
                    <th>Câu trả lời</th>
                    <th>Hiển thị</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->id }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ \Str::limit(strip_tags($faq->answer), 50) }}</td>
                        <td>
                            @if ($faq->is_active)
                                <span class="badge bg-primary">Hiển thị</span>
                            @else
                                <span class="badge bg-dark">Ẩn</span>
                            @endif
                        </td>
                        <td>{{ $faq->created_at->format('d/m/Y') }}</td>
                        <td>{{ $faq->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa FAQ này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Không có câu hỏi nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
@endsection
