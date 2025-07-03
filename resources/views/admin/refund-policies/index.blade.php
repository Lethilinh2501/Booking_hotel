@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4">Danh Sách Chính Sách Đền Bù</h2>

        <div class="mb-3">
            <a href="{{ route('admin.refund-policies.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Thêm Chính Sách
            </a>
        </div>

        <div class="card p-4">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Chính Sách</th>
                        <th>Nội dung</th>
                        <th style="width: 120px">Trạng thái</th>
                        <th style="width: 160px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($policies as $key => $policy)
                        <tr>
                            <td>{{ $policies->firstItem() + $key }}</td>
                            <td class="text-start">{{ $policy->title }}</td>
                            <td class="text-start">{{ \Illuminate\Support\Str::limit($policy->content, 80) }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $policy->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $policy->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.refund-policies.show', $policy->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                                <a href="{{ route('admin.refund-policies.edit', $policy->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.refund-policies.destroy', $policy->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa chính sách này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Chưa có chính sách nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $policies->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</main>
@endsection
