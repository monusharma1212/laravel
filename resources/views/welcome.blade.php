

@extends('main')
@section('hideHeader')  {{-- this hides header --}} @endsection

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    @include('auth.login')
</div>
@endsection
