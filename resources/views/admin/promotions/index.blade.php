@extends('layout.admin')

@section('content')

<div class="container mt-4">
    <h2>Danh sách khuyến mãi</h2>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary mb-3">+ Thêm khuyến mãi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Giảm (%)</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promo)
            <tr>
                <td>{{ $promo->title }}</td>
                <td>{{ $promo->discount_percent }}%</td>
                <td>{{ $promo->start_date }}</td>
                <td>{{ $promo->end_date }}</td>
                <td>
                    <a href="{{ route('admin.promotions.edit', $promo->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.promotions.destroy', $promo->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa thật hả?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $promotions->links() }}
</div>
@endsection
