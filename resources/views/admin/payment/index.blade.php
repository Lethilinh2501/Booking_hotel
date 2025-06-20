@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h3 class="mb-4">Danh Sách thanh toán</h3>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Mã Booking</th>
                            <th>Số tiền</th>
                            <th>Phương thức</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                              <td>{{ $payment->booking->booking_code }}</td>

                                <td>{{ number_format($payment->amount, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $payment->method }}</td>
                                <td>
                                    @if ($payment->status == 'completed')
                                        <span class="badge bg-success">Hoàn thành</span>
                                    @elseif ($payment->status == 'pending')
                                        <span class="badge bg-warning">Đang chờ</span>
                                    @else
                                        <span class="badge bg-danger">Thất bại</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.payment.show', $payment->id) }}"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('admin.payment.edit', $payment->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.payment.destroy', $payment->id) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirm('Xác nhận xóa thanh toán này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
