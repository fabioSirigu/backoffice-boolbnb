@extends('layouts.admin')

@section('content')
<a href="{{route('admin.homes.create')}}" class="btn btn-primary my-3" role="button">Add Home</a>
<div class="table-responsive pt-5">
      <table class="table table-striped
      table-hover	
      table-borderless
      table-primary
      align-middle">
            <thead class="table-light">

                  <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date Create</th>
                        <th>Actions</th>
                  </tr>
            </thead>
            <tbody class="table-group-divider">
                  @forelse ($homes as $home)
                  <tr class="table-primary">
                        <td scope="row">{{$home->id}}</td>
                        <td>

                              @if($home->cover_image)
                              <img width="100" class="img-fluid" src="{{asset('storage/' . $home->cover_image)}}" alt="">
                              @else
                              <div class="placeholder p-5 bg-secondary d-flex align-items-center justify-content-center" style="width:100px">Placeholder</div>
                              @endif

                        </td>
                        <td>{{$home->title}}</td>
                        <td>{{$home->address}}</td>
                        <td>{{$home->rooms}}</td>
                        <td>
                              <a href='{{route("admin.homes.show", $home->slug)}}' class="btn btn-primary view">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                              </a>
                              <a href='{{route("admin.homes.edit", $home->slug)}}' class="btn btn-secondary edit my-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                              </a>

                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHome-{{$home->slug}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg>
                              </button>
                              @include('partials.homes-modal')
                        </td>
                  </tr>
                  @empty
                  <tr class="table-primary">
                        <td>No homes found!</td>
                  </tr>
                  @endforelse
            </tbody>
            <tfoot>

            </tfoot>
      </table>
      <!-- $homes->links('vendor.pagination.bootstrap-5') -->
</div>


@endsection