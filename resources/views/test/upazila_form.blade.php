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
              Add Upazila
            @endif
          </div>
          <div class="card-body">
            <form method="post" action="{{ (@$editData)?route('upazila.update',$editData->id) : route('upazila.store') }}">
              @if (@$editData)
                {{ method_field('PUT') }}
              @endif
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="upazila_name">Upazila Name</label>
                    <input type="text" class="form-control" value="{{ @$editData->upazila_name }}" name="upazila_name" id="upazila_name" placeholder="Enter upazila name">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <select class="form-control" name="division_id" id="division_id">
                      <option >--Select Division--</option>
                      @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" {{ (@$editData->division_id == $division->id) ? "selected":""}}>{{ $division->division_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <select class="form-control" name="district_id" id="district_id">
                      <option >--Select District--</option>
                      @if (@$editData)

                        @foreach ($divisions as $district)
                          @foreach ($district->districts as $district)
                        <option value="{{ $district->id }}" {{ (@$editData->district_id == $district->id)?"selected":"" }}>{{ $district->district_name }}</option>
                              @endforeach
                            @endforeach
                        @else
                        
                      @endif
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ (@$editData)?"Update":"Submit" }}</button>
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

              <th scope="col">Upazila ID</th>
              <th scope="col">Upazila Name</th>
              <th scope="col">District Name</th>
              <th scope="col">Division Name</th>
              <th scope="col">Created at</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($divisions as $division)
              @foreach ($division->districts as $district)
                @foreach ($district->upazilas as $upazila)
                <tr>
                  <th scope="row">{{ $loop->index + 1}}</th>
                  <td>{{$upazila->id}}</td>
                  <td>{{$upazila->upazila_name}}</td>
                  <td>{{$district->district_name}}</td>
                  <td>{{$division->division_name}}</td>
                  <td>{{$upazila->created_at->format('m/d/Y')}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a type="button" class="btn btn-info btn-sm" href="{{ route('upazila.edit',$upazila->id) }}">Edit</a>
                      <form action="{{ URL::route('upazila.destroy', $upazila->id) }}" method="POST">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            @endforeach
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
  {{-- <script type="text/javascript">
    $(function(){
      $(document).on('change','#division_id',function(){
        var division_id = $(this).val();
        $.ajax({
          type:"GET",
          url:"{{ route('get_all_district') }}",
          data:{division_id:division_id},
          succsess:function(data){
            var html = '<option value="">Select District</option>';
            $.each(data,function(key,v){
              html +='<option value="'+v.id+'">'+v.district_name+'</option>';
            });
            $('#district_id').html(html);
          }
        });
      });
    });
  </script> --}}
@endsection

  @section('footer_script')
      <script type="text/javascript">
        $(document).ready(function(){
          $('#division_id').change(function(){
            var country_id = $(this).val();
            // alert(country_id);
            // ajaxSetup start
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // // ajaxSetup end

            // // ajaxSetup request start
            $.ajax({
              type: 'POST',
              url: '/get/city/list',
              data:{country_id:country_id},
              success:function(data){

                $('#district_id').html(data);
              }
            });
            // // ajaxSetup request end
          });
        });
      </script>

@endsection
