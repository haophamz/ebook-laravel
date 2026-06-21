@extends('layouts.app')

@section('title','Trang chủ')

@section('content')

    @include('partials.home-banner')

    @include('partials.home-featured')

    @include('partials.home-categories')

    @include('partials.home-latest')

    @include('partials.home-vip')

@endsection