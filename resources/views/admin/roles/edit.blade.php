@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">

            <h2 class="mb-4">Chỉnh sửa Quyền: {{ $role->name }}</h2>

            <div class="card p-4">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên quyền</label>
                        <select name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            <option value="">-- Chọn quyền --</option>
                            <option value="admin" {{ old('name', $role->name) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="user" {{ old('name', $role->name) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="receptionist" {{ old('name', $role->name) == 'receptionist' ? 'selected' : '' }}>
                                Lễ Tân</option>
                            <option value="customer" {{ old('name', $role->name) == 'customer' ? 'selected' : '' }}>Khách
                                hàng</option>
                        </select>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="guard_name" class="form-label">Guard Name</label>
                        <input type="text" name="guard_name" id="guard_name"
                            class="form-control @error('guard_name') is-invalid @enderror"
                            value="{{ old('guard_name', $role->guard_name) }}">
                        @error('guard_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">← Quay lại</a>
                </form>
            </div>

        </div>
    </main>
@endsection
