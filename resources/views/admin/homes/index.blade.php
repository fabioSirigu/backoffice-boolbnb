@extends('layouts.admin')

@section('content')
<a href="{{route('admin.homes.create')}}" class="btn btn-primary my-3" role="button">Add Home</a>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 py-4">Homes</h1>
</div>
@include('partials.message')
<div class="index_wrapper">
      <div class="index_elements">
            <div class="row justify-content-center">
                  @foreach ($homes as $home)
                  <div class="card m-3" style="width: 18rem;">
                        @if($home->cover_image)
                        <img class="img-fluid" src="{{asset('storage/' . $home->cover_image)}}" alt="">
                        @else
                        <div>Nessuna immagine</div>
                        @endif
                        <div class="card-body">
                              <h5 class="card-title">{{$home->title}}</h5>
                              <p class="card-text">{{$home->content}}</p>
                              <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn btn-primary" href="{{route('admin.homes.show', $home->slug)}}">
                                          View
                                    </a>
                                    <a href="{{route('admin.homes.edit', $home->slug)}}" class="btn btn-dark m-2">
                                          Edit
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHome-{{$home->slug}}">
                                          Delete
                                    </button>
                                    @include('partials.homes-modal')
                              </div>
                        </div>
                  </div>
                  @endforeach
            </div>
      </div>
</div>



@endsection