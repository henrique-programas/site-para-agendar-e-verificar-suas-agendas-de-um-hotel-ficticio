@extends('layouts.admin')

@section('page-title', 'Editar Quarto')
@section('breadcrumb', '<a href="'.route('admin.quartos.index').'" style="color:#c9a84c;">Quartos</a> / Editar Nº '.$room->number)

@section('content')
@include('admin.quartos._form', ['room' => $room, 'route' => route('admin.quartos.update', $room), 'method' => 'PUT'])
@endsection
