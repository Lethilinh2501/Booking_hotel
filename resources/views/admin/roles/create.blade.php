@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <div class="lh-page-title mb-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-1">Tạo Vai Trò Mới</h4>
            </div>

            <div class="card shadow-sm p-4">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    <!-- Tên vai trò -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Tên vai trò <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name"
                            placeholder="Nhập tên vai trò" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Chọn quyền -->
                    <div class="mb-3">
                        <h5 class="fw-semibold mb-2">Chọn quyền hạn</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            <label class="form-check-label fw-medium text-dark" for="selectAll">Chọn tất cả</label>
                        </div>

                        @foreach ($permission_groups as $groupIndex => $permission_group)
                            <div class="permission-group border rounded mt-3 p-3">
                                <div class="form-check group-header mb-2">
                                    <input class="form-check-input checkall-group" type="checkbox"
                                        data-group="{{ $groupIndex }}" id="group{{ $groupIndex }}">
                                    <label class="form-check-label fw-medium text-primary" for="group{{ $groupIndex }}">
                                        {{ __('permissions.section.' . $permission_group[0]['section']) }} - Tất cả
                                    </label>
                                </div>

                                <div class="row">
                                    @foreach ($permission_group as $permission)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input check-it" type="checkbox"
                                                    name="permissions[]" value="{{ $permission->id }}"
                                                    data-group="{{ $groupIndex }}" id="perm{{ $permission->id }}">
                                                <label class="form-check-label" for="perm{{ $permission->id }}">
                                                    {{ __($permission->name) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">← Quay lại</a>
                        <button type="submit" class="btn btn-success">Tạo mới</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <style>
        .permission-group:hover {
            background-color: #f9f9f9;
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }
    </style>

    <script>
        // Chọn tất cả
        document.getElementById('selectAll').addEventListener('change', function() {
            const checked = this.checked;
            document.querySelectorAll('.check-it, .checkall-group').forEach(cb => cb.checked = checked);
        });

        // Chọn tất cả theo nhóm
        document.querySelectorAll('.checkall-group').forEach(group => {
            group.addEventListener('change', function() {
                const groupIndex = this.dataset.group;
                const isChecked = this.checked;
                document.querySelectorAll(`.check-it[data-group="${groupIndex}"]`).forEach(cb => cb
                    .checked = isChecked);
            });
        });
    </script>
@endsection
