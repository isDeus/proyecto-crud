@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/departamento')}}" method="post" enctype="multipart/form-data">
@csrf
{{-- Se quita el cuestionario para ponerlo en su propio archivo (así permitiendo su reutilización), se hace referencia a ese archivo con include --}}
@include('departamento.form', ['modo'=>'Crear'])

</form>
</div>
@endsection
