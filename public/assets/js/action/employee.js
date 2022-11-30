$(document).ready( function () {
$.ajaxSetup({
  headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});
var url = window.location.origin;
var campus = 'mc';
$(document).on("click", ".add-employee" , function() {
  $('#employee-form')[0].reset();
  $('#employee-form').find('input[name="id"]').val('');
  $('#employeeModal').modal('show')
})
$(document).on("submit", "#employee-form" , function(e) {
  e.preventDefault();
  $.ajax({
      url:  '/employee/store',
      type: 'post',
      data: $('#employee-form').serialize(),
      beforeSend:function(){
        $('#employee-form').find('span').text('');
        $('#employee-form').find('input').removeClass('is-invalid');
        $('#employee-form').find('select').removeClass('is-invalid');
      },
      success:function(data){
        console.log(data);
          if(data.status === 200){
            $('#employee-table').DataTable().ajax.reload();
             $('.alertmessage').append('<div class="alert alert-success-faded" role="alert">Save Successfully!</div>')
          }else if(data.status === 400){
                  $.each(data.message, function(prefix,val){
                    
                      $('#employee-form').find('input[name="'+prefix+'"]').addClass('is-invalid');
                      $('#employee-form').find('select[name="'+prefix+'"]').addClass('is-invalid');
                      $('#employee-form').find('span.'+prefix+'_error').text(val[0]);
                  });
          }else if(data.status === 401){
            $('.alertmessage').append('<div class="alert alert-danger-faded" role="alert">'+data.message+'!</div>')
          } 
          $('.alert').delay(3000).fadeOut();
      }

  });
});

$(document).on("click", ".btn-edit-employee" , function(e) {
  e.preventDefault();
  const id = $(this).data('id')
  getInfo(id)
  $('#employeeModal').modal('show')
})

$(document).on("click", ".btn-delete-employee" , function(e) {
  e.preventDefault();
  const id = $(this).data('id')
  swal({
    title: "Are you sure?",
    text: "want to delete this record?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: '/employee/delete',
        type: 'post',
        data: {
              id
          },
        dataType: 'json',
        beforeSend:function(){
           // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
        },
        success:function(result){
            console.log('res: ', result);
            if(result.status == 200){
              $('#employee-table').DataTable().ajax.reload();
              swal(result.message, {
                icon: "success",
              });
            }else{
              swal("Server Error. try Again!", {
                icon: "error",
              });
            }
        }
      })
    }
  });
})




function getInfo(id){
  $.ajax({
    url: '/employee/one',
    type: 'post',
    data: {
          id
      },
    dataType: 'json',
    beforeSend:function(){
      $('#employee-form')[0].reset();
       // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
    },
    success:function(result){
        console.log('res: ', result);
        if(result.status == 200){
          $('#employee-form').find('input[name="id"]').val(result.data.id);
          $('#employee-form').find('input[name="firstname"]').val(result.data.firstname);
          $('#employee-form').find('input[name="middlename"]').val(result.data.middlename);
          $('#employee-form').find('input[name="lastname"]').val(result.data.lastname);
          $('#employee-form').find('input[name="agencyno"]').val(result.data.agencyno);
          $('#employee-form').find('select[name="department"]').val(result.data.department).change();
         // $('#employee-form').find('select[name="campus"]').val(result.data.campus).change();
          $('#employee-form').find('input[name="cellno"]').val(result.data.cellno);
          $('#employee-form').find('input[name="email"]').val(result.data.email);
          $('#employee-form').find('select[name="status"]').val(result.data.status).change();
          $('#employee-form').find('select[name="itemname"]').val(result.data.itemname).change();
          if(result.data.photo){
            $('.loadImageSrc').attr('src', url+"/storage/"+result.data.photo );
          }else{
            $('.loadImageSrc').attr('src', url+"/assets/images/profile1.jpg" );
          }

        }else{
          alert(result.message)
        }
    }
  })

}





//   $('.select-campus')
//   .change(function () {
//   campus = $(this).val()
//    $('#employee-table').DataTable().ajax.reload();
// });
$('#employee-table').DataTable({
  processing: true,
  //info: true,
  responsive : true,
  ordering: false,
  "ajax" :{
      "url" : "/employee/list",
        "type" : "POST",
        "data": function(set){
                  set.campus = campus;
              },
        error: function (xhr, error, code) {
              console.log(xhr, code);
          }
        },
   "pageLength": 10,
   "aLengthMenu":[[10,25,50,100,-1],[10,25,50,100,'All']],
    columns: [
      {data: 'id', name: 'id'},
      {data: 'photo', name: 'photo'},
      {data: 'name', name: 'name'},
      {data: 'agencyno', name: 'agencyno'},
      {data: 'department', name: 'department'},
      {data: 'cellno', name: 'cellno'},
      {data: 'email', name: 'email'},
      {data: 'status', name: 'status'},
      {data: 'itemname', name: 'itemname'},
      {data: 'action', name: 'action'},
      ],
      error: function(err) {
          if(err.status === 500){
              toastr.error('Server is Offline')  
          }
        }
 // "initComplete": isComplete,
});
});