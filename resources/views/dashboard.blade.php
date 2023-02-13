@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Accesso effettuato!') }}
                </div>
            </div>
            <div class="link-homes">
                <a class="btn btn-primary mt-4" href="{{route('admin.homes.index')}}" role="button">Vai alle Case</a>

            </div>
        </div>
    </div>
</div>
@endsection