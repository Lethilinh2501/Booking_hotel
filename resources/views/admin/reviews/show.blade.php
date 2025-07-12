@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="h4 mb-0">Chi tiết đánh giá #{{ $review ->id }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Quản lý đánh giá</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5 class="font-weight-bold">Chi tiết đánh giá</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Khách hàng:</strong><br> {{ $review ->user->name }}</p>
                                        <p><strong>Mã booking</strong><br> {{ $review ->booking->booking_code }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Đánh giá:</strong>
                                        <br> 
                                           @for ( $i=1;$i <= $review->rating ; $i++)
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            @endfor 
                                        </p>
                                        <p><strong>Ngày gửi:</strong><br> {{ $review ->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h5 class="font-weight-bold">Nội dung</h5>
                                <hr>
                                <div class="bg-light p-3 rounded">
                                    {!! nl2br(e($review ->comment)) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Tác vụ quản lý</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.reviews.updateResponse', $review ->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="response" class="font-weight-bold">Trạng thái hiện tại:</label>
                                            <div class="mb-2">
                                                <span class="text-dark">
                                                       {{$review ->response ?? "chưa phản hồi"}}
                                                </span>
                                            </div>
                                            <label for="response" class="font-weight-bold">Cập nhật trạng thái:</label>
                                            <input type="text" name="response" id="response" class="form-control" value="{{$review ->response }}"  placeholder="nhập phản hồi ">     
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mt-2 ">
                                            <i class="fas fa-save"></i> Lưu thay đổi
                                        </button>
                                    </form>

                                    <hr>

                                    {{-- <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="mt-3">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?')">
                                            <i class="fas fa-trash"></i> Xóa liên hệ
                                        </button>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
<style>
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-success {
        background-color: #28a745;
        color: white;
    }
    .badge-danger {
        background-color: #dc3545;
        color: white;
    }
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        font-size: 0.9rem;
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
        font-weight: 600;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .bg-light {
        background-color: #f8f9fa!important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
        
        $('.delete-form').on('submit', function() {
            return confirm('Bạn có chắc chắn muốn xóa liên hệ này?');
        });
    });
</script>
@endpush