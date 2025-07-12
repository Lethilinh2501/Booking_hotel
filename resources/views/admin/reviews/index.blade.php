@extends('layout.admin')



@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
        <div class="col-md-8">
            <h1 class="h3 mb-0">Danh sách đánh giá</h1>
        </div>
        <div class="col-md-4 text-right">
            <form action="{{ route('admin.reviews.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
        </div>
    @endif
    <div class="card  mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>khách hàng</th>
                            <th>Đánh giá</th>
                            <th>Nội dung</th>
                            <th>Phản hồi</th>
                            <th>Ngày gửi</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>       
                            @for ( $i=1;$i <= $review->rating ; $i++)
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            @endfor                   
                            </td>
                            <td>{{ Str::limit($review->comment, 30) }}</td>
                            <td>{{ Str::limit($review->response, 30) }}</td>               
                            <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                           
                                    <a href="{{ route('admin.reviews.show', $review->id) }}"
                                       class="btn btn-sm btn-info" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Xóa"
                                                onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
                              
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có đánh giá nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $reviews->links('pagination::bootstrap-5') }} --}}
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .table th {
        white-space: nowrap;
    }
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endpush
