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
        <h1 class="h3 mb-0 text-gray-800 py-4">Add a Home</h1>
    </div>
    <form action="{{route('admin.homes.store')}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" id="title" class="form-control" placeholder="Nome" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="rooms" id="rooms" class="form-control" placeholder="Stanze" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="beds" id="beds" class="form-control" placeholder="Letti" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="bathrooms" id="bathrooms" class="form-control" placeholder="Bagni" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="square_meters" id="square_meters" class="form-control" placeholder="Metri quadrati" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="address" id="address" class="form-control" placeholder="Indirizzo, Numero Civico" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitudine" aria-describedby="helpId" required>
        </div>
        <div class="mb-3">
            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitudine" aria-describedby="helpId" required>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" value=true id="visible">
            <label class="form-check-label" for="flexRadioDefault1">
              Visible
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" value=false id="visible" checked>
            <label class="form-check-label" for="flexRadioDefault2">
              Not Visible
            </label>
          </div>
        <div class="mb-3">
            <input type="file" class="form-control" name="image" id="image" placeholder="Aggiungi un'immagine" aria-describedby="coverImgHelper">
        </div>
        <button type="submit" class="btn btn-primary">Invia!</button>
    </form>
</div>
@endsection