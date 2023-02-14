@extends('layouts.admin')

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
<a href="{{route('admin.homes.create')}}" class="btn btn-primary my-3" role="button">Aggiungi Una Casa</a>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 py-4">Le Tue Case</h1>
</div>
@include('partials.message')
<div class="index_wrapper">
      <div class="index_elements">
            <div class="row justify-content-around">
                  @foreach ($homes as $home)
                  <div class="card m-3 text-center d-flex justify-content-center flex-column" style="width: 18rem;">
                        <div class="card-img mt-2">

                              @if($home->cover_image)
                              <img class="img-fluid" src="{{asset('storage/' . $home->cover_image)}}" alt="">
                              @else
                              <img src="/img/placeholder_600.png" alt="" class="img-fluid">

                              @endif
                        </div>
                        <div class="card-body">
                              <h5 class="card-title">{{$home->title}}</h5>
                              <p class="card-text">{{$home->content}}</p>
                              <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn btn-primary" href="{{route('admin.homes.show', $home->slug)}}">
                                          Visualizzza
                                    </a>
                                    <a href="{{route('admin.homes.edit', $home->slug)}}" class="btn btn-dark m-2">
                                          Modifica
                                    </a>
                              </div>
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHome-{{$home->slug}}">
                                    Cancella
                              </button>
                              @include('partials.homes-modal')
                        </div>
                  </div>
                  @endforeach
            </div>
      </div>
</div>



@endsection