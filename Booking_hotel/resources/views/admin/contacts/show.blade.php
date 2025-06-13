@extends('admin.layout.default')
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="h4 mb-0">Chi tiết liên hệ #{{ $contact->id }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Quản lý liên hệ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <h5 class="font-weight-bold">Thông tin liên hệ</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tiêu đề:</strong><br> {{ $contact->title }}</p>
                                <p><strong>Email:</strong><br> {{ $contact->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Điện thoại:</strong><br> {{ $contact->phone ?? 'N/A' }}</p>
                                <p><strong>Ngày gửi:</strong><br> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5 class="font-weight-bold">Nội dung</h5>
                        <hr>
                        <div class="bg-light p-3 rounded">
                            {!! nl2br(e($contact->content)) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Quản lý liên hệ</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="status" class="font-weight-bold">Trạng thái hiện tại:</label>
                                    <div class="mb-2">
                                        <span class="badge badge-{{ 
                                            $contact->status == 'approved' ? 'success' : 
                                            ($contact->status == 'rejected' ? 'danger' : 'warning') 
                                        }}">
                                            {{ ucfirst($contact->status) }}
                                        </span>
                                    </div>
                                    <label for="status" class="font-weight-bold">Cập nhật trạng thái:</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $contact->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $contact->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Cập nhật
                                </button>
                            </form>

                            <hr>

                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="mt-3">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                    <i class="fas fa-trash"></i> Xóa liên hệ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #2980b9;
            color: white;
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <main class="container-fluid flex-grow-1">
        <div class="container mt-4">
            <h2 class="mb-4">Chi Tiết Liên Hệ</h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Tiêu đề</th>
                        <td>{{ $contact->title }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <td>{{ $contact->phone }}</td>
                    </tr>
                    <tr>
                        <th>Nội dung</th>
                        <td>{{ $contact->content }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái hiện tại</th>
                        <td>{{ ucfirst($contact->status) }}</td>
                    </tr>
                </table>

                <form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST"
                    class="mt-3 d-flex align-items-center gap-3">
                    @csrf
                    <label for="status" class="form-label mb-0">Cập nhật trạng thái:</label>
                    <select name="status" id="status" class="form-select w-auto">
                        <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $contact->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $contact->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>

                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary mt-3">← Quay lại</a>
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
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
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