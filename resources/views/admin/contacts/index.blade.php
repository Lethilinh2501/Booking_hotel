@extends('layouts.admin')

@section('content')
<h1>Danh sách liên hệ</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->title }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ ucfirst($contact->status) }}</td>
            <td>
                <a href="{{ route('admin.contacts.show', $contact->id) }}">Chi tiết</a> |
                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $contacts->links() }}
@endsection
 
@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>