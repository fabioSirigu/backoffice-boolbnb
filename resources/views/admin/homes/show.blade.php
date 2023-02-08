@extends('layouts.admin')
@section('content')
<a class="btn btn-primary mt-4" href="{{route('admin.homes.index')}}" role="button"><i class="fas fa-angle-left fa-fw"></i>Go Home</a>
<div class="container p-5">
      <div class="card text-left bg-dark text-light">
            <div class="card-body">
                  <div class="id_home">
                        <h3>Home id: {{$home->id}}</h3>
                  </div>
                  @if($home->cover_image)
                  <img class="img-fluid" style="width:150px" src="{{asset('storage/' . $home->cover_image)}}" alt="">
                  @else
                  <div class="placeholder p-5 bg-secondary" style="width:100px">Placeholder</div>

                  @endif
                  <div>
                        <h1>Title: {{$home->title}}</h1>
                  </div>
                  <div>
                        <h1>Rooms: {{$home->rooms}}</h1>
                  </div>

                  <div>
                        <h3>Beds: {{$home->beds}}</h3>
                  </div>
                  <div>
                        <h3>Bathrooms: {{$home->bathrooms}}</h3>
                  </div>
                  <div>
                        <h3>Sq: {{$home->square_meters}}</h3>
                  </div>
                  <div>
                        <h3>Address: {{$home->address}}</h3>
                  </div>
                  <div>
                        <h3>Services:</h3>
                        <ul>
                              @forelse($services as $service)
                              @if($home->services->contains($service->id))
                              <li>{{$service->title}}</li>
                              @else
                              @endif
                              @empty
                              <h4>No services</h4>
                              @endforelse
                        </ul>
                  </div>
                  <div>
                        <h3>Messages:</h3>
                        <ul>

                              @forelse($messages as $message)
                              <li>
                                    <h3>{{$message->name }}</h3>
                                    <h5>email: {{$message->email }}</h5>
                                    <p>
                                          {{ $message->message}}
                                    </p>
                              </li>
                              @empty
                              <h5>No messages found!</h5>
                              @endforelse
                        </ul>
                  </div>
            </div>
      </div>



</div>
@endsection