@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Danh Mục Bài Viết</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle mr-2"></i>Thêm Mới
        </a>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bộ Lọc</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Tất cả</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="search" class="form-label">Tìm kiếm</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Nhập tên...">
                    </div>
                    <div class="col-md-4 d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter mr-1"></i> Lọc
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync-alt mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Danh Mục</h6>
            <span class="badge bg-primary">Tổng: {{ $categories->total() }} danh mục</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Tên danh mục</th>
                            <th width="35%">Mô tả</th>
                            <th width="15%">Trạng thái</th>
                            <th width="20%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-primary font-weight-bold">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td>{{ $category->description ? Str::limit($category->description, 100) : '---' }}</td>
                            <td>
                                <span class="badge badge-{{ $category->status == 'active' ? 'success' : 'secondary' }}">
                                    <i class="fas fa-{{ $category->status == 'active' ? 'eye' : 'eye-slash' }} mr-1"></i>
                                    {{ $category->status == 'active' ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                       class="btn btn-sm btn-primary mr-2" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                title="Xóa" onclick="return confirmDelete()">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="dataTables_info">
                    Hiển thị {{ $categories->firstItem() }} đến {{ $categories->lastItem() }} 
                    trong tổng {{ $categories->total() }} mục
                </div>
                <div class="pagination-custom">
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete() {
    return confirm('Bạn có chắc chắn muốn xóa danh mục này?');
}

// DataTable initialization
$(document).ready(function() {
    $('#dataTable').DataTable({
        paging: false,
        searching: false,
        info: false,
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [4] }
        ]
    });
});
</script>
@endsection

@section('styles')
<style>
    .pagination-custom .pagination {
        justify-content: flex-end;
    }
    .pagination-custom .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .table th {
        white-space: nowrap;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }
</style>
@endsection