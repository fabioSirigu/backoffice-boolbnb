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
<div id="app" class="div">
    <div class="container">
        <a href="{{route('admin.homes.index')}}" class="btn btn-primary my-3" role="button">Go Back</a>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 py-4">Add a Home</h1>
        </div>
        <form action="{{route('admin.homes.store')}}" method="post" class="card p-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title*</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="House Title" value="{{old('title')}}" aria-describedby="helpId" required>
            </div>
            <div class="mb-3 d-flex justify-content-between gap-3">
                <div class="flex-grow-1">
                    <label for="rooms" class="form-label">Rooms*</label>
                    <input type="number" name="rooms" id="rooms" class="form-control" placeholder="Number of rooms" value="{{old('rooms')}}" aria-describedby="helpId" required>
                </div>
                <div class="flex-grow-1">
                    <label for="beds" class="form-label">Beds*</label>
                    <input type="number" name="beds" id="beds" class="form-control" placeholder="Number of beds" value="{{old('beds')}}" aria-describedby="helpId" required>
                </div>
                <div class="flex-grow-1">
                    <label for="bathrooms" class="form-label">Bathrooms*</label>
                    <input type="number" name="bathrooms" id="bathrooms" class="form-control" placeholder="Number of bathrooms" value="{{old('bathrooms')}}" aria-describedby="helpId" required>
                </div>
                <div class="flex-grow-1">
                    <label for="square_meters" class="form-label">Square Meters*</label>
                    <input type="number" name="square_meters" id="square_meters" class="form-control" placeholder="Square Meters" value="{{old('square_meters')}}" aria-describedby="helpId" required>
                </div>
            </div>
    
            <div class="mb-3">
                <label v-model="address" for="address" class="form-label">Address*</label>
                <input type="text" name="address" id="address" class="form-control address" placeholder="Indirizzo, Numero Civico" value="{{old('address')}}" aria-describedby="helpId" required>
            </div>
    
            <div class="mb-3 d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visible" value="1" id="visible_1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Visible
                    </label>
                </div>
                <div class="form-check px-5">
                    <input class="form-check-input" type="radio" name="visible" value="0" id="visible_0">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Not Visible
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="services" class="form-label">Services*</label>
                <select multiple class="form-select form-select-sm" name="services[]" id="services">
                    <option value="" disabled>Select a Service</option>
    
    
                    @forelse ($services as $service)
                    <option value="{{$service->id}}" {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>{{$service->title}}</option>
                    @empty
                    <option value="" disabled>Sorry 😥 no services in the system</option>
                    @endforelse
    
                </select>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Add A Cover Image*</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="Aggiungi un'immagine" aria-describedby="coverImgHelper">
            </div>
            <p>
                <em>
                    * are required!
                </em>
            </p>
            <button type="submit" class="btn btn-primary">Invia!</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
const { createApp } = Vue

createApp({
  data() {
    return {
      message: 'Hello Vue!'
    }
  }
}).mount('#app')
</script>
@endsection