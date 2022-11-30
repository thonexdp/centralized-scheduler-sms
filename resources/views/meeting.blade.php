

@extends('includes.app')
<?php 
  $global = new App\Http\Controllers\GlobalVar();
  $campus = $global->allcampus();
  $status = $global->status();
  $itemname = $global->itemName();
?>
@section('content')
        <!-- Breadcrumbs-->
        <nav class="mb-4 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.html"><i class="ri-home-line align-bottom me-1"></i> Events</a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->

        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">

          <div class="card mb-4">
            <div class="card-header">
              <button class="btn btn-outline-light btn-sm add-meeting"> <i class="ri-add-line"></i> Add Events</button>
            </div>
            <div class="card-body">
              <h6 class="card-title">Meeting List</h6>
              <hr>
              <table class="table table-striped nowrap" id="meeting-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Topic</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Type</th>
                    <th scope="col">Venue/Link</th>
                    {{-- <th scope="col">AddedBy</th> --}}
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
         

        </div>
        <!-- Top Row Widgets-->

        

        {{-- <div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #24293b">
              <form id="meeting-form">
                <input type="hidden" name="id">
              <div class="modal-body" >
                <div class="card">
                  <div class="card-header justify-content-between align-items-center d-flex">
                      <h6 class="card-title m-0" style="color: aliceblue">Meeting Details</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="basic-url" class="form-label">Description</label>
                            <div class="input-group-sm mb-2">
                              <input type="text" class="form-control" name="description" id="basic-url" placeholder="Enter Description">
                              <small class="text-danger description_error"></small>
                            </div>
                        </div>
                        <div class="col-md-10">
                          <label for="basic-url" class="form-label">Topic</label>
                          <div class="input-group-sm mb-2">
                            <input type="text" class="form-control" name="topic" id="basic-url" placeholder="Enter Topic">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label for="basic-url" class="form-label">Type</label>
                          <div class="input-group-sm mb-2">
                            <select class="form-control" name="meetingtype" >
                              <option value="Virtual">Virtual</option>
                              <option value="In-Person">In-Person</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="basic-url" class="form-label">Date</label>
                          <div class="input-group-sm mb-2">
                            <input type="date" class="form-control" name="meetingdate" id="basic-url" placeholder="Enter Topic">
                            <small class="text-danger meetingdate_error"></small>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="basic-url" class="form-label">Time Start</label>
                          <div class="input-group-sm mb-2 ">
                            <input type="time" class="form-control" name="timestart" id="basic-url" placeholder="Enter Topic">
                            <small class="text-danger timestart_error"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="basic-url" class="form-label">&nbsp;</label>
                          <div class="input-group-sm mb-2 ">
                            <select class="form-control" name="duration">
                              <option value="whole">Whole day</option>
                              <option value="am">Morning</option>
                              <option value="pm">Afternoon</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <label for="basic-url" class="form-label venue-link">Venue</label>
                          <div class="input-group-sm mb-2 ">
                            <input type="text" class="form-control" id="basic-url" name="venue">
                           
                            <div class="venueReserved text-success"></div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success btn-sm"> <i class="ri-save-line"></i> Save changes</button>
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal"> <i class="ri-close-circle-line"></i> Close</button>
             
              </div>
            </form>
            </div>
          </div>
        </div> --}}


        <div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #24293b">
              {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> --}}
              <form id="meeting-form">
                <input type="hidden" name="id">
              <div class="modal-body" >
                <div class="card">
                  <div class="card-header justify-content-between align-items-center d-flex">
                      <h6 class="card-title m-0" style="color: aliceblue">Meeting Details</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="basic-url" class="form-label">Description</label>
                            <div class="input-group-sm mb-2">
                              <input type="text" class="form-control" name="description" id="basic-url" placeholder="Enter Description">
                              <small class="text-danger description_error"></small>
                            </div>
                        </div>
                        <div class="col-md-10">
                          <label for="basic-url" class="form-label">Topic</label>
                          <div class="input-group-sm mb-2">
                            <input type="text" class="form-control" name="topic" id="basic-url" placeholder="Enter Topic">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label for="basic-url" class="form-label">Type</label>
                          <div class="input-group-sm mb-2">
                            <select class="form-control" name="meetingtype" >
                              <option value="Virtual">Virtual</option>
                              <option value="In-Person">In-Person</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="basic-url" class="form-label">Date</label>
                          <div class="input-group-sm mb-2">
                            <input type="date" class="form-control" name="meetingdate" id="basic-url" placeholder="Enter Topic">
                            <small class="text-danger meetingdate_error"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="basic-url" class="form-label">Time Start</label>
                          <div class="input-group-sm mb-2 ">
                            <input type="time" class="form-control" name="timestart" id="basic-url" placeholder="Enter Topic">
                            <small class="text-danger timestart_error"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="basic-url" class="form-label">Time End</label>
                          <div class="input-group-sm mb-2 ">
                            <input type="time" class="form-control" name="timend" id="basic-url" placeholder="Enter Topic">
                            <small class="text-danger timestart_error"></small>
                          </div>
                        </div>
                        {{-- <div class="col-md-3">
                          <label for="basic-url" class="form-label">&nbsp;</label>
                          <div class="input-group-sm mb-2 ">
                            <select class="form-control" name="duration">
                              <option value="whole">Whole day</option>
                              <option value="am">Morning</option>
                              <option value="pm">Afternoon</option>
                            </select>
                          </div>
                        </div> --}}
                        <div class="col-md-12 div-link" >
                          <label for="basic-url" class="form-label venue-link">Link</label>
                          <div class="input-group-sm mb-2 ">
                            <input type="text" class="form-control" id="basic-url" name="link">
                            <div class="venueReserved text-success"></div>
                          </div>
                        </div>
                        <div class="col-md-12 div-venue" style="display: none;">
                          <label for="basic-url" class="form-label venue-link">Venue</label>
                          <div class="input-group-sm mb-2 ">
                            <input type="text" class="form-control" id="basic-url" name="venue">
                            <div class="venueReserved text-success"></div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success btn-sm"> <i class="ri-save-line"></i> Save changes</button>
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal"> <i class="ri-close-circle-line"></i> Close</button>
             
              </div>
            </form>
            </div>
          </div>
        </div>
        
       
@endsection
<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/action/meeting.js')}}" type="text/javascript"></script>





