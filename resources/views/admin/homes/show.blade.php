@extends('layouts.admin')
@section('content')
<a class="btn btn-primary mt-4" href="{{route('admin.homes.index')}}" role="button"><i class="fas fa-angle-left fa-fw"></i>Torna alle case</a>
<div class="container p-5">
      <div class="card text-left bg-dark text-light">
            <div class="card-body">
                  @if($home->cover_image)
                  <img class="img-fluid" style="width:150px" src="{{asset('storage/' . $home->cover_image)}}" alt="">
                  @else
                  <div class="placeholder p-5 bg-secondary" style="width:350px">Placeholder</div>

                  @endif
                  <div>
                        <h1>Nome: {{$home->title}}</h1>
                  </div>
                  <div>
                        <h1>Stanze: {{$home->rooms}}</h1>
                  </div>

                  <div>
                        <h3>Letti: {{$home->beds}}</h3>
                  </div>
                  <div>
                        <h3>Bagni: {{$home->bathrooms}}</h3>
                  </div>
                  <div>
                        <h3>Metri Quadrati: {{$home->square_meters}}</h3>
                  </div>
                  <div>
                        <h3>Indirizzo: {{$home->address}}</h3>
                  </div>
                  <div>
                        <h3>Servizi:</h3>
                        <ul>
                              @forelse($services as $service)
                              @if($home->services->contains($service->id))
                              <li>{{$service->title}}</li>
                              @else
                              @endif
                              @empty
                              <h4>Nessun servizio</h4>
                              @endforelse
                              <!-- risolvere questo empty che non funziona -->
                        </ul>
                  </div>
                  <div>
                        <h3>Messaggi:</h3>
                        <ul>
                              @forelse($messages as $message)
                              <li>
                                    <h3>{{$message->name }}</h3>
                                    <h5>Email: {{$message->email }}</h5>
                                    <p>
                                          {{ $message->message}}
                                    </p>
                              </li>
                              @empty
                              <h5>Nessun messaggio per questa casa.</h5>
                              @endforelse
                        </ul>
                  </div>
            </div>
      </div>



</div>
@endsection