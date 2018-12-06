@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
@endpush

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __("Manejar mis suscripciones"),'icon' => 'list-ol'])
@endsection

@section('content')