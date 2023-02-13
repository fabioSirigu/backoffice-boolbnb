@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <a href="{{route('admin.homes.index')}}" class="btn btn-primary my-3" role="button">Torna indietro</a>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 py-4">Modifica {{$home->title}}</h1>
    </div>
    <form action="{{route('admin.homes.update', $home->slug)}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf

        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Nome*</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Nome" value="{{old('title', $home->title)}}" aria-describedby="helpId" required>
        </div>
        <div class="mb-3 d-flex gap-2 justify-content-between gap-3">
            <div class="flex-grow-1">
                <label for="rooms" class="form-label">Stanze*</label>
                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="Stanze" value="{{old('rooms', $home->rooms)}}" aria-describedby="helpId" required>
            </div>
            <div class="flex-grow-1">
                <label for="beds" class="form-label">Letti*</label>
                <input type="number" name="beds" id="beds" class="form-control" placeholder="Letti" value="{{old('beds', $home->beds)}}" aria-describedby="helpId" required>
            </div>
            <div class="flex-grow-1">
                <label for="bathrooms" class="form-label">Bagni*</label>
                <input type="number" name="bathrooms" id="bathrooms" class="form-control" placeholder="Bagni" value="{{old('bathrooms', $home->bathrooms)}}" aria-describedby="helpId" required>
            </div>
            <div class="flex-grow-1">
                <label for="square_meters" class="form-label">Metri Quadrati*</label>
                <input type="number" name="square_meters" id="square_meters" class="form-control" placeholder="Metri quadrati" value="{{old('square_meters', $home->square_meters)}}" aria-describedby="helpId" required>
            </div>
        </div>
        <div class="mb-3">
            <div class="d-flex">
                <div class="w-50">
                    <label v-model="address" for="address" class="form-label">Indirizzo*</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Indirizzo, Numero Civico" value="{{old('address', $home->address)}}" aria-describedby="helpId" required>
                </div>

                <div class="mx-2 flex-grow-1" id="results">
                    <label v-model="address" for="address" class="form-label">Seleziona l'indirizzo corretto</label>

                    <select id="address-options" class="form-select" aria-label="Default select example"></select>
                </div>
            </div>
        </div>
        <div class="mb-3 d-flex">
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" @if(old('visible',$home->visible)=="1") checked @endif name="visible" id="visible_1" >
                <label class="form-check-label" for="flexRadioDefault1">
                    Visibile
                </label>
            </div>
            <div class="form-check px-5">
                <input class="form-check-input" type="radio" name="visible" value="0" @if(old('visible',$home->visible)=="0") @endif id="visible_0" >
                <label class="form-check-label" for="flexRadioDefault2">
                    Non Visibile
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="services" class="form-label">Services*</label>
            <select multiple class="form-select form-select-sm" name="services[]" id="services">
                <option value="" disabled>Seleziona Servizi</option>


                @forelse ($services as $service)
                <option value="{{$service->id}}" {{((is_array(old('services')) && in_array($service->id, old('services'))) || $home->services->contains($service->id)) ? 'selected' : ''}}>
                    {{$service->title}}
                </option>
                @empty
                <option value="" disabled>Scusa 😥 nessun servizio nel sistema...</option>
                @endforelse

            </select>
        </div>
        <div class="mb-3 d-flex align-items-center gap-4">
            <img width="200px" src="{{asset('storage/' . $home->cover_image)}}">
            <div class="w-100">
                <label for="cover_image" class="form-label">Immagine di Copertina*</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="Aggiungi un'immagine" aria-describedby="coverImgHelper">
            </div>
        </div>
        <p>
            <em>
                * campi obbligatori
            </em>
        </p>
        <button type="submit" class="btn btn-primary">Invia!</button>
    </form>
</div>
<!-- <script src="{{asset('/js/autocomplete.js')}}"></script> -->
<script>
    const API_KEY = "Tch0NAfmIoUvMhD8OyuIvJnGGUrV2269";

    var searchInput = document.getElementById("address");
    var resultsContainer = document.getElementById("address-options");

    searchInput.addEventListener("input", function(e) {
        const searchTerm = e.target.value;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", `https://api.tomtom.com/search/2/search/${searchTerm}.json?key=${API_KEY}&limit=5`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                const searchResults = JSON.parse(xhr.responseText);

                resultsContainer.innerHTML = "";
                for (const result of searchResults.results) {
                    const resultOption = document.createElement("option");
                    resultOption.value = result.address.freeformAddress;
                    resultOption.innerText = result.address.freeformAddress;
                    resultsContainer.appendChild(resultOption);
                }
            }
        };
        xhr.send();
    });
    resultsContainer.addEventListener("change", function(e) {
        searchInput.value = e.target.value;
    });
</script>
@endsection