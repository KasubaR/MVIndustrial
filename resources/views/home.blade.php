@extends('layouts.app')

@section('nav_active', 'home')

@section('content')
    @include('sections.hero')
    @include('sections.services')
    @include('sections.about')
    @include('sections.clients')
    @include('sections.quote-band')
@endsection
