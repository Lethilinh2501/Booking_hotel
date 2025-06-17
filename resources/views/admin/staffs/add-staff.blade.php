@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Thêm Nhân Viên</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.staffs.addPostStaff') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên nhân viên</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nhập tên nhân viên" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Email nhân viên" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Chức vụ</label>
                        <select class="form-select" id="role_id" name="role_id">
                            <option value="">-- Chọn chức vụ --</option>
                            @foreach ($listRole as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Đang hoạt động
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
                </form>
            </div>
        </div>
    </main>
@endsection
