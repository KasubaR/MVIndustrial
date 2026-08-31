@extends('layouts.app')

@section('nav_active', 'home')

{{-- Opts this one-page layout into the JS scroll spy that highlights nav links. --}}
@section('body_attributes', 'data-scrollspy')

@section('content')
    @include('sections.hero')
    @include('sections.services')
    @include('sections.about')
    @include('sections.clients')
    @include('sections.quote-band')
@endsection
