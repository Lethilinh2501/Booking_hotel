@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">

            <h2 class="mb-4">Tạo Quyền Mới</h2>

            <div class="card p-4">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên quyền</label>
                        <select name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            <option value="">-- Chọn quyền --</option>
                            <option value="admin" {{ old('name') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('name') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="receptionist" {{ old('name') == 'receptionist' ? 'selected' : '' }}>Lễ Tân
                            </option>
                            <option value="customer" {{ old('name') == 'customer' ? 'selected' : '' }}>Khách hàng</option>
                        </select>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="guard_name" class="form-label">Guard Name</label>
                        <input type="text" name="guard_name" id="guard_name"
                            class="form-control @error('guard_name') is-invalid @enderror"
                            value="{{ old('guard_name', 'web') }}">
                        @error('guard_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Tạo mới</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">← Quay lại</a>
                </form>
            </div>

        </div>
    </main>
@endsection
