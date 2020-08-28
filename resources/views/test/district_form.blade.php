@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            @if (@$editData)
              Edit District
              @else
              Add District
            @endif
          </div>
          <div class="card-body">
            <form method="post" action="{{ (@$editData)?route('district.update',$editData->id) : route('district.store') }}">
              @if (@$editData)
                {{ method_field('PUT') }}
              @endif
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="district_name">District Name</label>
                    <input type="text" class="form-control" value="{{ @$editData->district_name }}" name="district_name" id="district_name" placeholder="Enter District name">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <select class="form-control" name="division_id">
                      <option >--Select Division--</option>
                      @foreach ($division_lists as $division)
                        <option value="{{ $division->id }} " {{ (@$editData->division_id == $division->id) ? "selected" : ""}}>{{ $division->division_name }}</option>
                      @endforeach
                    </select>
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
              <th scope="col">District ID</th>
              <th scope="col">District Name</th>
              <th scope="col">Under Division</th>
              <th scope="col">Created at</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($division_lists as $division)
              @foreach ($division->districts as $district)
                <tr>
                  <th scope="row">{{ $loop->index + 1}}</th>
                  <td>{{$district->id}}</td>
                  <td>{{$district->district_name}}</td>
                  <td>{{$division->division_name}}</td>
                  <td>{{$district->created_at->format('m/d/Y')}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a type="button" class="btn btn-info btn-sm" href="{{ route('district.edit',$district->id) }}">Edit</a>
                      <form action="{{ URL::route('district.destroy', $district->id) }}" method="POST">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                  </td>
                </tr>
              @endforeach
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
