@extends('layouts.admin')
@section('content')
<a class="btn btn-primary mt-4" href="{{route('admin.homes.index')}}" role="button"><i class="fas fa-angle-left fa-fw"></i>Torna all'Area Personale</a>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Title</h3>
                <p class="card-text">Text</p>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Title</h3>
                <p class="card-text">Text</p>
            </div>
        </div>
    </div>
</div>
@endsection