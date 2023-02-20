@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sponsorship Confirmation') }}</div>

                <div class="card-body">
                    <p>Grazie per aver sottoscritto una sponsorizzazione!</p>
                    <a href="{{ route('admin.homes.index') }}" class="btn btn-primary">Torna alla lista dei tuoi appartamenti</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection