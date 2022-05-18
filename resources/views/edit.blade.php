@extends('app')

@section('title', 'Editar Diarista')

@section('content')

<h1>Editar Diarista</h1>
<form action="{{ route('diaristas.update', $diarista) }}" method="POST" enctype="multipart/form-data">

    @method('PUT')
    @include('_form')

</form>

@endsection