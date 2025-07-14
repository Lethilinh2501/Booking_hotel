@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chỉnh sửa Vai Trò</h2>

            <div class="card p-4">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên vai trò</label>
                        <input class="form-control" type="text" name="name" placeholder="Nhập tên vai trò"
                            value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <h5 class="form-label-title">Quyền hạn</h5>
                    </div>

                    <div class="row g-sm-4 g-2">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input checkall" type="checkbox" id="selectAll">
                                        <label class="form-check-label" for="selectAll">Chọn tất cả</label>
                                    </div>
                                </div>

                                @foreach ($permission_groups as $groupIndex => $permission_group)
                                    <div class="col-12 mt-3 permission-group">
                                        <div class="form-check group-header">
                                            <input class="form-check-input checkall-group" type="checkbox"
                                                data-group="{{ $groupIndex }}" id="group{{ $groupIndex }}">
                                            <label class="form-check-label" for="group{{ $groupIndex }}">
                                                {{ __('permissions.section.' . $permission_group->first()->guard_name) }} -
                                                Tất cả
                                            </label>
                                        </div>

                                        <div class="permission-items mt-2 ms-4">
                                            @foreach ($permission_group as $permission)
                                                <div class="form-check permission-item">
                                                    <input class="form-check-input check-it" type="checkbox"
                                                        name="permissions[]" value="{{ $permission->id }}"
                                                        data-group="{{ $groupIndex }}" id="perm{{ $permission->id }}"
                                                        {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="perm{{ $permission->id }}">{{ __($permission->name) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">← Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Chọn tất cả
        document.getElementById('selectAll').addEventListener('change', function() {
            document.querySelectorAll('.check-it, .checkall-group').forEach(cb => cb.checked = this.checked);
        });

        // Chọn theo nhóm
        document.querySelectorAll('.checkall-group').forEach(groupCb => {
            groupCb.addEventListener('change', function() {
                const group = this.dataset.group;
                document.querySelectorAll(`.check-it[data-group="${group}"]`).forEach(cb => cb.checked =
                    this.checked);
            });
        });
    </script>
@endsection
