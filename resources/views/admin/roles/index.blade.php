@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4">Danh sách Quyền (Role)</h2>

        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">+ Tạo Role mới</a>

        <div class="card p-4">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Tên quyền</th>
                        <th>Guard Name</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $key => $role)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                            <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $role->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hành động
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $role->id }}">
                                        <li>
                                            <a href="{{ route('admin.roles.show', $role->id) }}" class="dropdown-item">
                                                <i class="bi bi-eye me-2"></i>Chi tiết
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="dropdown-item">
                                                <i class="bi bi-pencil-square me-2"></i>Sửa
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa quyền này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash me-2"></i>Xóa
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Chưa có quyền nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Phân trang --}}
            {{ $roles->links('pagination::bootstrap-5') }}
        </div>
    </div>
</main>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection
