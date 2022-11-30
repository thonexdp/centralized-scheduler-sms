

@extends('includes.app')
<?php $global = new App\Http\Controllers\GlobalVar(); ?>
@section('content')
        <!-- Breadcrumbs-->
        <nav class="mb-4 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.html"><i class="ri-home-line align-bottom me-1"></i> Department</a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->

        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">
          <div class="card mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                  <button class="btn btn-outline-primary btn-sm add-department">Add Deparment</button>
                </div>
                {{-- <div class="col-md-4">
                  <select class="form-control float-right select-campus" name="select-campus">
                    <?php $campuses = $global->allcampus() ?>
                    @foreach($campuses as $campus)
                     <option value="{{$campus[0]}}">{{$campus[1]}}</option>
                    @endforeach
                  </select>
                </div> --}}
              </div>
            
            </div>
            <div class="card-body">
              <h6 class="card-title">Deparment List</h6>
              <hr>
              <table class="table table-striped" id="department-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>

        </div>
        <!-- Top Row Widgets-->

        <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content" style="background-color: #24293b">
              {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> --}}
              <form id="department-form">
                @csrf
              <div class="modal-body" >
                <input type="hidden" name="id">
                <div class="card">
                  <div class="card-header justify-content-between align-items-center d-flex">
                      <h6 class="card-title m-0" style="color: aliceblue">Deparment</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="basic-url" class="form-label">Name</label>
                            <div class="input-group-sm mb-2">
                              <input type="text" class="form-control" id="basic-url" name="name" placeholder="Enter Name">
                              <span class="text-danger name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                          <label for="basic-url" class="form-label">Description</label>
                          <div class="input-group-sm mb-2">
                            <input type="text" class="form-control" id="basic-url" name="description" placeholder="Enter Description">
                            <span class="text-danger description_error"></span>
                          </div>
                        </div>
                        {{-- <div class="col-md-12">
                          <label for="basic-url" class="form-label">Campus</label>
                          <div class="input-group-sm">
                            <select class="form-control" name="campus">
                              <option value="" selected disabled> - Select Campus - </option>
                              <option value="mc">Main Campus</option>
                              <option value="bc">Bontoc Campus</option>
                              <option value="toc">Tomas Oppus Campus</option>
                              <option value="mcc">Maasin City Campus</option>
                              <option value="sjc">San Juan Campus</option>
                              <option value="hc">Hinunangan Campus</option>
                            </select>
                            <span class="text-danger campus_error"></span>
                          </div>
                        </div> --}}
                        <div class="col-md-12 mt-2 alertmessage"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal"><i class="ri-close-circle-line"></i> Close</button>
                <button type="submit" class="btn btn-outline-success btn-sm"><i class="ri-save-line"></i> Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        
       
@endsection
<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/action/department.js')}}" type="text/javascript"></script>





