@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 bg-light rounded-3">
    <div class="container py-5">
        <h2><img src="/img/logoBnBlateral.png" alt="" class="logo_lateral"></h2>
        @if (Auth::user())
        <h1>Benvenuto <strong>{{ Auth::user()->name }} </strong> in BoolBnB</h1>
        @else
        <h1>Benvenuto in BoolBnB, accedi o registrati!</h1>
        @endif
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis reprehenderit accusantium facere id aliquid iure dignissimos doloremque ab at molestiae. Adipisci modi debitis deleniti cupiditate ab in quibusdam voluptatibus nam. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius totam, laboriosam esse minima architecto blanditiis deserunt tenetur aut voluptatibus molestiae ab quidem tempora, quis commodi praesentium? Magnam eos eaque enim!
        </p>
        @if (Auth::user())
        <a href="{{route('admin.homes.index')}}" class="btn btn-primary">Vedi Tutte Le Case</a>
        @endif
    </div>
</div>

@endsection