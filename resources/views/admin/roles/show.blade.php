@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">

        <h2 class="mb-4">Chi tiết Quyền: {{ $role->name }}</h2>

        <div class="card p-4">
            <div class="mb-3">
                <strong>Tên quyền:</strong>
                <div class="form-control">{{ $role->name }}</div>
            </div>

            <div class="mb-3">
                <strong>Guard Name:</strong>
                <div class="form-control">{{ $role->guard_name }}</div>
            </div>

            <div class="mb-3">
                <strong>Ngày tạo:</strong>
                <div class="form-control">{{ $role->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>

    </div>
</main>

@endsection
