

@extends('includes.app')
<?php 
  $global = new App\Http\Controllers\GlobalVar();
  $campus = $global->allcampus();
  $status = $global->status();
  $itemname = $global->itemName();
?>
@section('content')
<style>
  tbody {
    background-color: #f2f2f2;
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
  tr th{
    color: #000;
  }
</style>
        <!-- Breadcrumbs-->
        <nav class="mb-1 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.html"><i class="ri-home-line align-bottom me-1"></i> <b class="text-muted">Meeting</b> </a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->

        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">

          <div class="card maincard">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h5 class="card-title m-0" style="color: aliceblue">Meeting Details</h5>
                <a href="/meeting" class="btn btn-outline-primary btn-sm"><i class="ri-arrow-left-line"></i> Back</a>
            </div>
            <div class="card-body">
              @if(!empty($meeting))
              <input type="hidden" name="meeting_id" value="{{ $meeting->id}}">
              <input type="hidden" name="meeting_date" value="{{ $meeting->date}}">
              <input type="hidden" name="meeting_duration" value="{{ $meeting->duration}}">
              <input type="hidden" name="meeting_start" value="{{ $meeting->timestart}}">
              <input type="hidden" name="meeting_end" value="{{ $meeting->timend}}">
              <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"> {{ $meeting->description}}</h4>
                <p>{{ $meeting->topic}}.</p>
                <p>{{ date('F d, Y', strtotime($meeting->date)  ) }}. {{ $meeting->timestart}}/{{ $meeting->duration}}</p>
                <hr>
                <p class="text-danger mb-0"> <i class="ri-error-warning-line"></i> <i>Employee who have conflict for this meeting schedule will not be listed in table below.</i> </p>
            </div>
            @endif

              <div class="row">
                <hr>
                <div class="col-md-7" style=" border-right: 1px solid #f2f2f2;height: 100%;">
                    <div class="justify-content-between align-items-center d-flex">
                      <h6>Employee MasterList </h6>
                      <button class="btn btn-outline-success btn-sm pull-right save-participants"><i class="ri-user-shared-2-line"></i> Add Participants</button>
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="basic-url" class="form-label">Designation</label>
                      <div class="input-group-sm mb-2 ">
                        <select class="form-control status-c" >
                          <option value="">All</option>
                          @foreach($itemname as $item)
                          <option value="{{$item}}">{{$item}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="basic-url" class="form-label">Department</label>
                    <div class="input-group-sm mb-2 ">
                      <select class="form-control department-c">
                        <option value="">All</option>
                        @foreach($department as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                {{-- <div class="col-md-4">
                  <label for="basic-url" class="form-label">Campus</label>
                  <div class="input-group-sm mb-2 ">
                    <select class="form-control campus-c">
                      <option value="">All Campus</option>
                      @foreach($campus as $item)
                      <option value="{{$item[0]}}">{{$item[1]}}</option>
                      @endforeach
                    </select>
                </div>
              </div> --}}
                  </div>
                  <table class="table" id="employeelist-table-participants">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" name="checkall" name="checkall"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Department</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
                <div class="col-md-5" >
                  <div class="justify-content-between align-items-center d-flex">
                     <h6>Participants List</h6>
                     <button class="btn btn-outline-info btn-sm pull-right send-msg" ><i class="ri-mail-send-line"></i> Send Message</button>
                  </div>
                  <hr>
                  <table class="table" id="participants-table">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Department</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
               
              </div>
                     
               
                 
          
            </div>
          </div>

          
        </div>
        <!-- Top Row Widgets-->

        <div class="modal fade" id="sendMsgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content" style="background-color: #060e4d">
              {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> --}}
              <form id="sendsms-form">
              <div class="modal-body" >
                <input type="hidden" name="id">
                <div class="card" style="background-color: #060e4d">
                  <div class="card-header justify-content-between align-items-center d-flex">
                      <h6 class="card-title text-center m-0" style="color: aliceblue">Send Message Notifications to the participants!</h6>
                  </div>
                  <center><small class="text-danger"> <b>Note:</b> <i> Only for valid numbers will received the message! </i>  </small></center> 
                  <div class="card-body" style=" display: none">
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="maincategory" value="vp"
                                    id="flexRadioDefault2" >
                                <label class="form-check-label form-label" for="flexRadioDefault2">
                                    via Email
                                </label>
                              </div>
                          </div>
                          <div class="col-md-6 text-center">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="maincategory" value="vp"
                                  id="flexRadioDefault2" >
                              <label class="form-check-label form-label" for="flexRadioDefault2">
                                via SMS
                              </label>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal"><i class="ri-close-circle-line"></i> Cancel</button>
                <button type="submit" class="btn btn-outline-success btn-sm btn-sendsms"><i class="ri-send-plane-fill"></i> Send Now</button>
              </div>
            </form>
            </div>
          </div>
        </div>

       
@endsection
<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/action/participants.js')}}" type="text/javascript"></script>





