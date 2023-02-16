@extends('layouts.admin')
@section('content')
<a class="btn btn-primary mt-4" href="{{route('admin.homes.index')}}" role="button"><i class="fas fa-angle-left fa-fw"></i>Torna all'Area Personale</a>

<div class="index_wrapper">
    <div class="index_elements">
        <div class="row justify-content-center">
            @foreach ($sponsoreds as $sponsored)
            <div class="card m-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$sponsored->title}}</h5>
                    <div>Prezzo: {{$sponsored->price}} €</div>
                    <div>Durata: {{$sponsored->duration}} h</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection