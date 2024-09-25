
@extends('layouts.backend')

@section('content')


<h1 class="text-3xl text-black pb-6">Welcome To {{ (!empty($url) ? strFilter($url) : "My") }} Dashboard!</h1>


@endsection
