@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Danh sách Giới thiệu</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('admin.abouts.create') }}" class="btn btn-primary mb-3">Thêm Giới thiệu</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Nội dung</th>
                            <th>Hiển thị</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($abouts as $key => $about)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{!! Str::limit(strip_tags($about->about), 100) !!}</td>
                                <td>
                                    @if ($about->is_use)
                                        <span class="badge bg-success">Đang dùng</span>
                                    @else
                                        <span class="badge bg-secondary">Không dùng</span>
                                    @endif
                                </td>
                                <td>{{ $about->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.abouts.edit', $about->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="{{ route('admin.abouts.show', $about->id) }}"
                                        class="btn btn-info btn-sm">Xem</a>
                                    <form action="{{ route('admin.abouts.destroy', $about->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Xác nhận xoá?')">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Không có bản ghi nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
