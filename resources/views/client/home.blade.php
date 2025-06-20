@extends('layout.client')

@section('content')
    @include('client.layouts.blocks.slider')
    @include('client.rooms.index')
    @include('client.layouts.service')
    @include('client.layouts.blog')
@endsection
