@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập Nhật Chính Sách Hoàn Tiền</h2>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.refund-policies.update', $policy->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <table class="table table-bordered align-middle mb-4">
                        <tbody>
                            <tr>
                                <th style="width: 200px">Tên chính sách</th>
                                <td>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $policy->name) }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Số ngày trước Check-in</th>
                                <td>
                                    <input type="number" name="days_before_checkin" class="form-control"
                                        value="{{ old('days_before_checkin', $policy->days_before_checkin) }}"
                                        min="0" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Phần trăm hoàn trả (%)</th>
                                <td>
                                    <input type="number" name="refund_percentage" class="form-control"
                                        value="{{ old('refund_percentage', $policy->refund_percentage) }}" min="0"
                                        max="100" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Phí huỷ (%)</th>
                                <td>
                                    <input type="number" name="cancellation_fee_percentage" class="form-control"
                                        value="{{ old('cancellation_fee_percentage', $policy->cancellation_fee_percentage) }}"
                                        min="0" max="100" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Mô tả</th>
                                <td>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $policy->description) }}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <select name="is_active" class="form-select">
                                        <option value="1" {{ $policy->is_active ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="0" {{ !$policy->is_active ? 'selected' : '' }}>Không hoạt động
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Cập Nhật
                        </button>
                        <a href="{{ route('admin.refund-policies.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
