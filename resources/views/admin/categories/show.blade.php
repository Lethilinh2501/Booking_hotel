@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="m-0 font-weight-bold">
                        <i class="fas fa-folder-open mr-2"></i>Chi Tiết Danh Mục
                    </h4>
                    <div>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-light btn-sm mr-2">
                            <i class="fas fa-edit mr-1"></i> Sửa
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Quay lại
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <h5 class="info-label">ID Danh Mục</h5>
                                <p class="info-value">{{ $category->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <h5 class="info-label">Trạng Thái</h5>
                                <span class="badge badge-{{ $category->status == 'active' ? 'success' : 'secondary' }} p-2">
                                    <i class="fas fa-{{ $category->status == 'active' ? 'eye' : 'eye-slash' }} mr-1"></i>
                                    {{ $category->status == 'active' ? 'Đang hiển thị' : 'Đang ẩn' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="info-item">
                                <h5 class="info-label">Tên Danh Mục</h5>
                                <p class="info-value font-weight-bold">{{ $category->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="info-item">
                                <h5 class="info-label">Mô Tả</h5>
                                <div class="info-value p-3 bg-light rounded">
                                    {!! $category->description ? nl2br(e($category->description)) : '<span class="text-muted">Không có mô tả</span>' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <h5 class="info-label">Ngày Tạo</h5>
                                <p class="info-value">
                                    <i class="far fa-calendar-alt mr-1 text-primary"></i>
                                    {{ $category->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <h5 class="info-label">Cập Nhật Cuối</h5>
                                <p class="info-value">
                                    <i class="far fa-calendar-check mr-1 text-primary"></i>
                                    {{ $category->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                <i class="fas fa-trash-alt mr-1"></i> Xóa Danh Mục
                            </button>
                        </form>
                        <div>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary mr-2">
                                <i class="fas fa-edit mr-1"></i> Chỉnh Sửa
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list mr-1"></i> Danh Sách
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .info-label {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 0.3rem;
    }
    .info-value {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    .card-header {
        border-bottom: none;
    }
    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.8em;
    }
</style>
@endsection