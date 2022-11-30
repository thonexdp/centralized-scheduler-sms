$(document).ready( function () {
  var campus = 'mc';
$.ajaxSetup({
  headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});
$(document).on("click", ".add-department" , function() {
  $('#department-form').find('input[name="id"]').val('');
  $('#departmentModal').modal('show')
})
$(document).on("submit", "#department-form" , function(e) {
  e.preventDefault();
  $.ajax({
      url:  '/department/store',
      type: 'post',
      data: $('#department-form').serialize(),
      beforeSend:function(){
        $('#department-form').find('span').text('');
      },
      success:function(data){
        console.log(data);
          if(data.status === 200){
            $('#department-table').DataTable().ajax.reload();
             $('.alertmessage').append('<div class="alert alert-success-faded" role="alert">Save Successfully!</div>')
          }else if(data.status === 400){
                  $.each(data.message, function(prefix,val){
                      $('#department-form').find('span.'+prefix+'_error').text(val[0]);
                  });
          }else if(data.status === 401){
            $('.alertmessage').append('<div class="alert alert-danger-faded" role="alert">'+data.message+'!</div>')
          } 
          $('.alert').delay(3000).fadeOut();
      }

  });
});

$(document).on("click", ".btn-edit-department" , function(e) {
  e.preventDefault();
  const id = $(this).data('id')
  getInfo(id)
  $('#departmentModal').modal('show')
})

$(document).on("click", ".btn-delete-department" , function(e) {
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
        url: '/department/delete',
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
              $('#department-table').DataTable().ajax.reload();
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
    url: '/department/one',
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
          $('#department-form').find('input[name="id"]').val(result.data.id);
          $('#department-form').find('input[name="name"]').val(result.data.name);
          $('#department-form').find('input[name="description"]').val(result.data.description);
          $('#department-form').find('select[name="campus"]').val(result.data.campus).change();
        }else{
          alert(result.message)
        }
    }
  })

}

// $('.select-campus')
// .change(function () {
// campus = $(this).val()
//  $('#department-table').DataTable().ajax.reload();
// });
$('#department-table').DataTable({
  processing: true,
  //info: true,
  responsive : true,
  ordering: false,
  "ajax" :{
      "url" : "/department/bycampus",
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
      {data: 'id', name: 'action'},
      {data: 'name', name: 'name'},
      {data: 'description', name: 'description'},
      // {data: 'campus', name: 'campus'},
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