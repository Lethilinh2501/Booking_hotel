@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Chỉnh Sửa Danh Mục</h4>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" id="category-form" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Tên danh mục -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Tên danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" 
                                   value="{{ old('name', $category->name) }}"
                                   required
                                   minlength="3"
                                   maxlength="255">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tối thiểu 3 ký tự, tối đa 255 ký tự</div>
                        </div>
                        
                        <!-- Mô tả -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" 
                                      rows="4">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Trạng thái -->
                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Trạng thái <span class="text-danger">*</span></label>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="status" id="active" 
                                       value="active" autocomplete="off" 
                                       {{ old('status', $category->status) == 'active' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="active">
                                    <i class="fas fa-eye"></i> Hiển thị
                                </label>
                                
                                <input type="radio" class="btn-check" name="status" id="inactive" 
                                       value="inactive" autocomplete="off"
                                       {{ old('status', $category->status) == 'inactive' ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="inactive">
                                    <i class="fas fa-eye-slash"></i> Ẩn
                                </label>
                            </div>
                            @error('status')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Thông tin phụ -->
                        <div class="mb-4 border-top pt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Ngày tạo:</strong> {{ $category->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Lần cập nhật cuối:</strong> {{ $category->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Nút submit -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-danger me-md-2">
                                <i class="fas fa-undo"></i> Nhập lại
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validate form client-side
    const form = document.getElementById('category-form');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    }, false);
});
</script>
@endsection