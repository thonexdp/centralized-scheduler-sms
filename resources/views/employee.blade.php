
<?php 
  $global = new App\Http\Controllers\GlobalVar();
?>
@extends('includes.app')
@section('content')

        <!-- Breadcrumbs-->
        <nav class="mb-4 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.html"><i class="ri-home-line align-bottom me-1"></i> Employee</a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->
        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">

          <div class="card mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-outline-light btn-sm add-employee"><i class="ri-add-line"></i> Add Employee</button>
                </div>
                
              </div>
              
              
            </div>
            <div class="card-body">
              <h6 class="card-title">Employee List</h6>
              <hr>
              <div class="table-responsive">
              <table class="table table-striped nowrap" id="employee-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">AgencyNo</th>
                    <th scope="col">Department</th>
                    <th scope="col">CellNo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">ItemName</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            </div>
          </div>
       
        </div>
        <!-- Top Row Widgets-->

        <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #24293b">
              {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> --}}
              <form id="employee-form">
              <div class="modal-body" >
                <input type="hidden" name="id">
                <div class="card">
                  <div class="card-header justify-content-between align-items-center d-flex">
                      <h6 class="card-title m-0" style="color: aliceblue">Employee Details</h6>
                  </div>
                  <div class="card-body">
                      <input type="hidden" name="filepath">
                    <div class="row">
                        <div class="class-col-md-12">
                          <div id="uploadedimage">
                            <img style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white loadImageSrc" src="{{asset('assets/images/profile1.jpg')}}" alt="..." />
                          </div>
                          <!--  <form method="post" enctype="multipart/form-data">  -->

                          <div class="form-group" style="margin-top: -10px;">
                            <p class="title">Profile Photo</p>
                            <!-- <input type="file" id="file" name="file"  class="custom-file getimage"   onchange="showPreview(event);" > -->
                            <input style=" font-size: 10px; color: white; " type="file" name="uploadimage" id="uploadimage" accept="image/*">
                          </div>
                        </div>
                        <div class="col-md-4">
                            <label for="basic-url" class="form-label">FirstName</label>
                            <div class="input-group-sm mb-2">
                              <input type="text" class="form-control" name="firstname" id="basic-url" >
                              <span class="text-danger firstname_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <label for="basic-url" class="form-label">MiddleName</label>
                          <div class="input-group-sm mb-2">
                            <input type="text" class="form-control" name="middlename" id="basic-url">
                            <span class="text-danger middlename_error"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <label for="basic-url" class="form-label">LastName</label>
                        <div class="input-group-sm mb-2">
                          <input type="text" class="form-control" name="lastname" id="basic-url">
                          <span class="text-danger lastname_error"></span>
                        </div>
                      </div>
                        <div class="col-md-4">
                          <label for="basic-url" class="form-label">AgencyNo</label>
                          <div class="input-group-sm mb-2">
                            <input type="text" class="form-control" name="agencyno" id="basic-url">
                            <span class="text-danger agencyno_error"></span>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <label for="basic-url" class="form-label">Department</label>
                          <div class="input-group-sm mb-2">
                             <select class="form-control" name="department">
                               <option value="">--Select--</option>
                               @isset($department)
                                  @foreach ($department as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                               @endisset
                             </select>
                             <span class="text-danger department_error"></span>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <label for="basic-url" class="form-label">CellNo.</label>
                          <div class="input-group-sm mb-2">
                            <input type="text" class="form-control" name="cellno" id="basic-url">
                            <span class="text-danger cellno_error"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="basic-url" class="form-label">Email</label>
                          <div class="input-group-sm mb-2">
                            <input type="email" class="form-control" name="email" id="basic-url">
                            <span class="text-danger email_error"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="basic-url" class="form-label">Status</label>
                          <div class="input-group-sm mb-1">
                            <select class="form-control" name="status">
                              <option value="">Select</option>
                              <?php $status = $global->status() ?>
                              @foreach($status as $item)
                               <option value="{{$item}}">{{$item}}</option>
                              @endforeach
                            </select>
                            <span class="text-danger status_error"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="basic-url" class="form-label">ItemName</label>
                          <div class="input-group-sm mb-2">
                            <select class="form-control" name="itemname">
                              <option value="">Select</option>
                              <?php $itemname = $global->itemName() ?>
                              @foreach($itemname as $item)
                               <option value="{{$item}}">{{$item}}</option>
                              @endforeach
                            </select>
                            <span class="text-danger itemname_error"></span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-12 mt-2 alertmessage"></div>
                        </div>
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




        <div class="modal fade" id="upload_imageModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content" style=" width: 450px;" >
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Crop Image</b></h4>
                  </div>
                  <div class="modal-body" align="center" >
                       <div id="image_demo" style="width: 350px; margin-top: 30px;">
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button class="btn btn-success btn-flat crop_image" name="save"><i class="fa fa-crop"></i> Crop</button>
                  </div>
              </div>
          </div>
      </div>
        
       
@endsection
<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/action/employee.js')}}" type="text/javascript"></script>
<script>
  
$(document).ready(function() {


 

    $('#employeeModal').on('hidden.bs.modal', function () {
      $('input[name="filepath"]').val('');
    });
     $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 200,
            height: 200
        }
    });
    $('#uploadimage').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                // alert('bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#upload_imageModal').modal('show');
    });

    $('.crop_image').click(function(event) {
      var url = window.location.origin;
     
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(responce) {
            $.ajax({
                url: 'employee/cropimage',
                type: 'post',
                cache:false,
                data: { 'image': responce },
                success: function(data) {
                  if(data.status == 200){
                    $('#upload_imageModal').modal('hide');
                    $('.loadImageSrc').attr('src', url+"/storage/"+data.path );
                    $('input[name="filepath"]').val(data.path);
                  }else{
                    alert('error convert image')
                  }
                   
                  //  $('#uploadedimage').html(data);
                    // alert(''+data);
                }
            });
        });
    });
});
</script>







