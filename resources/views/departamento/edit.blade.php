@extends('layouts.app')

@section('content')
<div class="container">

{{-- Se crea un formulario para realizar el update, se cambia el method de post a patch --}}
<form action="{{url('/departamento/'.$departamento->id)}}" method="POST" enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}

{{-- Se incluye el cuestionario --}}
{{-- Se añade una variable en el include para especificar de dónde viene el include hacia form --}}
@include('departamento.form', ['modo'=>'Editar'])

</form>
</div>
@endsection
