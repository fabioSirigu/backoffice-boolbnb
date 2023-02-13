@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 py-4">Modifica {{$service->title}}</h1>
    </div>
    <form action="{{route('admin.services.update', $service->slug)}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf

        @method('PUT')
        <div class="mb-3">
            <input type="text" name="title" id="title" class="form-control" placeholder="Nome" value="{{old('title', $service->title)}}" aria-describedby="helpId" required>
        </div>
        <button type="submit" class="btn btn-primary">Invia!</button>
    </form>
</div>
@endsection