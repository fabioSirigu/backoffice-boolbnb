@extends('layouts.admin')

@section('content')
<a href="{{route('admin.services.create')}}" class="btn btn-primary my-3" role="button">Add Service</a>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 py-4">Services</h1>
</div>
@include('partials.message')
<div class="index_wrapper">
      <div class="index_elements">
            <div class="row justify-content-center">
                  @foreach ($services as $service)
                  <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                              <h5 class="card-title">{{$service->title}}</h5>
                              <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{route('admin.services.edit', $service->slug)}}" class="btn btn-dark m-2">
                                          Edit
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteService-{{$service->slug}}">
                                          Delete
                                    </button>
                                    @include('partials.services-modal')
                              </div>
                        </div>
                  </div>
                  @endforeach
            </div>
      </div>
</div>



@endsection