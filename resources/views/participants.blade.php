

@extends('includes.app')
@section('content')

<style>
  table {
    background-color: #f2f2f2;
    color: #000;
  }
  tr th {
    color: #000;
  }
  tbody tr td {
   font-weight: bold;
  }
  .maincard {
    background-color: #f2f2f2; 
    color: #000; 
    box-shadow: 5px 5px 5px 5px lightblue;
  }
</style>
        <!-- Breadcrumbs-->
        <nav class="mb-1 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/participants"><i class="ri-home-line align-bottom me-1"></i> <b class="text-muted">Participants</b> </a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->

        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">
          <div class="card maincard mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                   <p>Description: <b id="meeting-des"> </b></p> 
                    <p>Date/Time: <b id="meeting-datetime"> </b></p> 
                    <p>Venue: <b id="meeting-venue"> </b></p> 
                </div>
                <div class="col-md-4">
                  <select class="form-control float-right select-meeting" name="select-campus">
                    <option value="">-- Select Meeting -- </option>
                    @if(!empty($meeting))
                    @foreach($meeting as $item)
                      <option value="{{$item->id}}">{{ $item->description}}</option>
                    @endforeach
                  @endif
                   
                  </select>
                </div>
              </div>
            
            </div>
            <div class="card-body">
              <h6 class="card-title">Participants List</h6>
              <hr>
              <table class="table nowrap" id="participantsemployee-table">
                <thead>
                  <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Employee Name</th>
                    {{-- <th scope="col">Description</th>
                    <th scope="col">Time</th> --}}
                    <th scope="col">Department</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>

        </div>
        
        <!-- Top Row Widgets-->

     
       
@endsection
<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/action/participants.js')}}" type="text/javascript"></script>





