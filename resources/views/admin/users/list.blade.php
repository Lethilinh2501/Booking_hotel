@extends('layout.admin')



@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
        <div class="col-md-8">
            <h1 class="h3 mb-0">Danh sách khách hàng</h1>
        </div>
        <div class="col-md-4 text-right">
            <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline">
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
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>TÊN</th>
                            <th>AVATAR</th>               
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>QUYỀN SỞ HỮU</th>
                            <th>NGÀY GỬI</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                            @if ($user->avatar)
                                <img class="bg-info-subtle rounded d-flex justify-content-center align-items-center fs-20"
                                    src="{{asset('storage/' . $user->avatar)}}" style="width: 50px;height: 50px"
                                    alt="Avatar"/>
                            @else
                                <div class="bg-info-subtle rounded d-flex justify-content-center align-items-center fs-20"
                                    style="width: 50px;height: 50px">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            </td>                                          
                            <td>{{ $user->email }}</td>       
                            <td>                    
                                   @if ($user->is_active == '1')
                                   <span class="badge bg-success">Hoạt động</span>
                                   @else
                                   <span class="badge bg-danger">Vô hiệu hóa</span>
                                   @endif
                                </span>                     
                            </td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                <a href="{{route('admin.users.show', $user->id) }}"
                                class="btn btn-sm btn-info" >
                                    <i class="fas fa-eye">Chi tiết</i>
                                </a>    
                                    {{-- <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Xóa"
                                                onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có liên hệ nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @php
                $currentPage = $users->currentPage();
                $lastPage = $users->lastPage();
            @endphp

            <ul class="pagination"> 
                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $currentPage == 1 ? '#' : $users->url($currentPage - 1) }}">Previous</a>
                </li>

                @for ($i = 1; $i <= $lastPage; $i++)
                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $currentPage == $lastPage ? '#' : $users->url($currentPage + 1) }}">Next</a>
                </li>
            </ul>


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
