@extends('layouts.admin')

@section('content')
<a href="{{route('admin.sponsored.create')}}" class="btn btn-primary my-3" role="button">Add Sponsored</a>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 py-4">Sponsored</h1>
</div>
@include('partials.message')
<div class="index_wrapper">
      <div class="index_elements">
            <div class="row justify-content-center">
                  @foreach ($sponsoreds as $sponsored)
                  <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                              <h5 class="card-title">{{$sponsored->title}}</h5>
                              <div>Prezzo: {{$sponsored->price}} €</div>
                              <div>Durata: {{$sponsored->duration}} h</div>
                              <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{route('admin.sponsored.edit', $sponsored->slug)}}" class="btn btn-dark m-2">
                                          Edit
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSponsored-{{$sponsored->slug}}">
                                          Delete
                                    </button>
                                    @include('partials.sponsored-modal')
                              </div>
                        </div>
                  </div>
                  @endforeach
            </div>
      </div>
</div>



@endsection