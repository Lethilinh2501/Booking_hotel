@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif


            <h2 class="mb-4">Danh sách Quyền (Role)</h2>

            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">+ Tạo Role mới</a>

            <div class="card p-4">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Tên quyền</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $role->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ri-settings-3-line"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $role->id }}">
                                            <li>
                                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="dropdown-item">
                                                    <i class="bi bi-pencil-square me-2"></i>Sửa
                                                </a>
                                            </li>
                                            @if (!in_array(strtolower($role->name), ['super admin', 'admin', 'lễ tân', 'customer']))
                                                <li>
                                                    <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="ri-delete-bin-line"></i> Xóa
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
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
