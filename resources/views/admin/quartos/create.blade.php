@extends('layouts.admin')

@section('page-title', 'Novo Quarto')
@section('breadcrumb', '<a href="'.route('admin.quartos.index').'" style="color:#c9a84c;">Quartos</a> / Novo')

@section('content')
@include('admin.quartos._form', ['room' => null, 'route' => route('admin.quartos.store'), 'method' => 'POST'])
@endsection
