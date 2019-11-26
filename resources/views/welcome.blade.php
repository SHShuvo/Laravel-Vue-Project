@extends('layouts.app')

@section('nav')
    @include('layouts.custom')
@endsection

@section('content')
    <div class="container-fluid">
        <router-view></router-view>
    </div>
@endsection
