

@extends('includes.app')
@section('content')
        <!-- Breadcrumbs-->
        <nav class="mb-4 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/participants"><i class="ri-home-line align-bottom me-1"></i> Participants</a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->

        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">
          <div class="card mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                 
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
              <table class="table table-striped nowrap" id="participantsemployee-table">
                <thead>
                  <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Time</th>
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





