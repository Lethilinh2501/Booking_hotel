@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập Nhật Nhân Viên</h2>

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.staffs.updatePatchStaff', $staff->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- Tên --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên nhân viên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $staff->user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $staff->user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Số điện thoại --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone', $staff->user->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Địa chỉ --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address', $staff->user->address) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Chức vụ --}}
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Chức vụ</label>
                        <select class="form-select @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                            <option value="">-- Chọn chức vụ --</option>
                            @foreach ($listRole as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $staff->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ca làm việc --}}
                    <div class="mb-3">
                        <label for="shift_id" class="form-label">Ca làm việc</label>
                        <select class="form-select @error('shift_id') is-invalid @enderror" name="shift_id" id="shift_id">
                            <option value="">-- Chọn ca làm việc --</option>
                            @foreach ($listShift as $shift)
                                <option value="{{ $shift->id }}"
                                    {{ old('shift_id', $staff->shift_id) == $shift->id ? 'selected' : '' }}>
                                    {{ $shift->name }} ({{ $shift->start_time }} - {{ $shift->end_time }})
                                </option>
                            @endforeach
                        </select>
                        @error('shift_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Trạng thái --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                            {{ old('is_active', $staff->status == 'active') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Đang hoạt động</label>
                    </div>

                    {{-- Ghi chú (nếu cần) --}}
                    <div class="mb-3">
                        <label for="notes" class="form-label">Ghi chú</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $staff->notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Cập nhật nhân viên</button>
                </form>
            </div>
        </div>
    </main>
@endsection
