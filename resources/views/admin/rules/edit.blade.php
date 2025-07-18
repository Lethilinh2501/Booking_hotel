@extends('layout.admin')

@section('content')
    <div class="lh-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 mx-auto">
                    <div class="lh-card" id="bookingtbl">
                        <div class="lh-card-header d-flex justify-content-between align-items-center">
                            <h4 class="lh-card-title mb-0">Chỉnh sửa Quy định</h4>
                            <a href="javascript:void(0)" class="lh-full-card" data-bs-toggle="tooltip" title="Phóng to">
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </div>

                        <div class="lh-card-content p-4">
                            <form action="{{ route('admin.rules.update', $rule->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Tên quy định -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Tên Quy định <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $rule->name) }}" placeholder="Nhập tên quy định">
                                    @error('name')
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Áp dụng loại phòng -->
                                <div class="form-group">
                                    <label class="form-label fw-bold">Áp dụng cho loại phòng <span
                                            class="text-danger">*</span></label>

                                    <div class="mb-2">
                                        <input class="form-check-input" type="checkbox" id="selectAllRooms">
                                        <label class="form-check-label fw-semibold ms-1" for="selectAllRooms">Tất cả loại
                                            phòng</label>
                                    </div>

                                    <div class="row">
                                        @php
                                            $selectedRooms = old('roomTypes', $rule->roomTypes->pluck('id')->toArray());
                                        @endphp

                                        @foreach ($roomTypes->chunk(ceil($roomTypes->count() / 2)) as $chunk)
                                            <div class="col-md-6">
                                                @foreach ($chunk as $roomType)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input room-type-checkbox" type="checkbox"
                                                            name="roomTypes[]" value="{{ $roomType->id }}"
                                                            id="roomType{{ $roomType->id }}"
                                                            {{ in_array($roomType->id, $selectedRooms) ? 'checked' : '' }}>
                                                        <label class="form-check-label ms-1"
                                                            for="roomType{{ $roomType->id }}">
                                                            {{ $roomType->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('roomTypes')
                                        <p class="text-danger small mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trạng thái -->
                                <div class="mb-4">
                                    <label for="is_active" class="form-label fw-bold">Trạng thái <span
                                            class="text-danger">*</span></label>
                                    <select name="is_active" id="is_active" class="form-select">
                                        <option value="1"
                                            {{ old('is_active', $rule->is_active) == 1 ? 'selected' : '' }}>Hoạt động
                                        </option>
                                        <option value="0"
                                            {{ old('is_active', $rule->is_active) == 0 ? 'selected' : '' }}>Không hoạt động
                                        </option>
                                    </select>
                                    @error('is_active')
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.rules.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                                    <button type="submit" class="btn btn-primary">Cập nhật Quy định</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const selectAllCheckbox = document.getElementById('selectAllRooms');
        const roomCheckboxes = document.querySelectorAll('.room-type-checkbox');

        selectAllCheckbox?.addEventListener('change', function() {
            roomCheckboxes.forEach(cb => cb.checked = this.checked);
        });

        // Nếu tất cả đã được chọn thì tick luôn checkbox "Tất cả"
        window.addEventListener('DOMContentLoaded', () => {
            const allChecked = Array.from(roomCheckboxes).every(cb => cb.checked);
            if (allChecked) {
                selectAllCheckbox.checked = true;
            }
        });
    </script>

    <style>
        .form-check-input {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .form-group .row {
            margin-top: 10px;
        }

        .form-group label.form-label {
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
