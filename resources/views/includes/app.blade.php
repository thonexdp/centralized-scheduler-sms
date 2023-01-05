<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.header')
    <body class="" style="background-color: #f2f2f2;">

     @include('includes.navbar')
    
        <!-- Page Content -->
        <main id="main">
     <!-- Content-->
       <section class="container-fluid">
             @yield('content')

             @include('includes.footer')
        </section>
    
        </main>
        <!-- /Page Content -->
    
        <!-- Page Aside-->

        @include('includes.sidebar')
       
    
        <!-- Theme JS -->
        <!-- Vendor JS -->
        <script src="{{asset('assets/js/vendor.bundle.js')}}"></script>
        
        <!-- Theme JS -->
        <script src="{{asset('assets/js/theme.bundle.js')}}"></script>
        <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/jquery.datatables.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/croppie/croppie.js')}}" type="text/javascript"></script>
        <script>
            

            $(document).ready( function () {
                $.ajaxSetup({
                  headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                var url = window.location.origin;
                var campus = 'mc';
                $(document).on("click", ".edit-my-profile" , function() {
                  // $('#employee-form')[0].reset();
                  // $('#employee-form').find('input[name="id"]').val('');
                  $('#mypModal').modal('show')
                })



                $(document).on("submit", "#myprofile-form" , function(e) {
                    e.preventDefault();
                    $.ajax({
                        url:  '/update_profile',
                        type: 'post',
                        data: $('#myprofile-form').serialize(),
                        beforeSend:function(){
                          // $('#employee-form').find('span').text('');
                          // $('#employee-form').find('input').removeClass('is-invalid');
                          // $('#employee-form').find('select').removeClass('is-invalid');
                        },
                        success:function(data){
                          console.log(data);
                            if(data.status === 200){
                              alert(data.message)
                            }$('#mypModal').modal('hide')

                            
                            //if(data.status === 400){
                            //         $.each(data.message, function(prefix,val){
                                      
                            //             $('#employee-form').find('input[name="'+prefix+'"]').addClass('is-invalid');
                            //             $('#employee-form').find('select[name="'+prefix+'"]').addClass('is-invalid');
                            //             $('#employee-form').find('span.'+prefix+'_error').text(val[0]);
                            //         });
                            // }else if(data.status === 401){
                            //   $('.alertmessage').append('<div class="alert alert-danger-faded" role="alert">'+data.message+'!</div>')
                            // } 
                            // $('.alert').delay(3000).fadeOut();
                        }

                    });
                  });




             })
        </script>
        <div class="modal fade" id="mypModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content" style="background-color: #060e4d">
                <form id="myprofile-form">
                <div class="modal-body" >
                  <div class="card" style="background-color: #060e4d">
                    <div class="card-header justify-content-between align-items-center d-flex">
                        <h6 class="card-title m-0" style="color: aliceblue">My Profile</h6>
                    </div>
                    <div class="card-body">
                      <input type="hidden" name="id" value="{{session('id')}}">
                      <div class="row">
                          <div class="col-md-12">
                              <label for="basic-url" class="form-label">UserName</label>
                              <div class="input-group-sm mb-2">
                                <input type="text" class="form-control" name="username" id="basic-url" placeholder="Enter Username" value="{{ session('username') }}">
                                <small class="text-danger description_error"></small>
                              </div>
                          </div>
                          
                          <div class="col-md-12">
                            <label for="basic-url" class="form-label">PassWord <small class="text-danger ml-1"><i>NOTE: Leave it blank if no changes of password!</i></small></label>
                            <div class="input-group-sm mb-2">
                              <input type="password" class="form-control" name="password" id="basic-url" placeholder="Enter Password">
                              <small class="text-danger description_error"></small>
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
    </body>
</html>
