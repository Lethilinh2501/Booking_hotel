@extends('layouts.admin')

@section('content')
<h2>Chi tiết liên hệ</h2>

<p><strong>Tiêu đề:</strong> {{ $contact->title }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Điện thoại:</strong> {{ $contact->phone }}</p>
<p><strong>Nội dung:</strong> {{ $contact->content }}</p>
<p><strong>Trạng thái hiện tại:</strong> {{ ucfirst($contact->status) }}</p>

<form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST">
    @csrf
    <label for="status">Cập nhật trạng thái:</label>
    <select name="status" id="status">
        <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ $contact->status == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ $contact->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
    <button type="submit">Cập nhật</button>
</form>

<a href="{{ route('admin.contacts.index') }}">← Quay lại danh sách</a>
@endsection

@push('styles')
    <style>
        h2 {
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            margin-right: 10px;
        }

        select {
            margin-right: 10px;
        }
    </style>