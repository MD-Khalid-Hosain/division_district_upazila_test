@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            @if (@$editData)
              Edit Division
              @else
              Add Division
            @endif
          </div>
          <div class="card-body">
            <form method="post" action="{{ (@$editData)?route('division.update',$editData->id) : route('division.store') }}">
              @if (@$editData)
                {{ method_field('PUT') }}
              @endif
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="division_name">Division Name</label>
                    <input type="text" class="form-control" value="{{ @$editData->division_name }}"name="division_name" id="division_name" placeholder="Enter division name">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ (@$editData) ? "Update": "Submit" }}</button>
              </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">
      <div class="col-md-8">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Division ID</th>
              <th scope="col">Division Name</th>
              <th scope="col">Created at</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($division_lists as $division_list)

            <tr>
              <th scope="row">{{ $loop->index + 1}}</th>
              <td>{{$division_list->id}}</td>
              <td>{{$division_list->division_name}}</td>
              <td>{{$division_list->created_at->format('m/d/Y')}}</td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a type="button" class="btn btn-info btn-sm" href="{{ route('division.edit', $division_list->id ) }}">Edit</a>
                  {{-- <a type="button" class="btn btn-danger btn-sm" href="">Delete</a> --}}
                  <form action="{{ URL::route('division.destroy', $division_list->id) }}" method="POST">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
              </td>
            </tr>
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
