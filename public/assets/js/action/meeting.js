$(document).ready(function () {

  $('.bycampus').hide();
  $('.secondDiv').hide();
  $('.thirdDiv').hide();
  $('.venue').hide();

  var isVenueType = false;
  $('.allstatus').hide();
  
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  })
  $(document).on("click", ".add-meeting", function () {
    $('#meeting-form').find('input[name="id"]').val('');
    $('#meeting-form')[0].reset();
    $('#meetingModal').modal('show')

  })


  $('select[name="meetingtype"]').change(function () {
    const val = $(this).val()
    if (val == 'Virtual') {
     // $('.venue-link').text('Link')
     // $('input[name="venue"]').attr('name', 'link');
      $('.div-venue').hide();
      $('.div-link').show();
      isVenueType = false;
    }else{
      isVenueType = true;
      $('.div-venue').show();
      $('.div-link').hide();
     // $('.venue-link').text('Venue')
      //$('input[name="venue"]').attr('name', 'venue');
    }

  })
  $('input[name="maincategory"]').change(function () {
    const val = $(this).val()

    if (val == 'vp') {
      $('.bycampus').hide();
      $('.secondDiv').hide();
      $('.thirdDiv').hide();
      unCheckCampus()
      unCheckDepartments()
      unCheckItemName()
    $('input[name="secondCat"]').prop("checked", false);
    $('.allemployee').prop("checked", false);


    } else if (val == 'allcampus') {
      $('.bycampus').hide();
      $('.secondDiv').show();
    $('input[name="secondCat"]').prop("checked", false);
    $('.allemployee').prop("checked", true);
      unCheckCampus()
    } else if (val == 'bycampus') {
      $('.bycampus').show();
      $('.secondDiv').show();
    $('input[name="secondCat"]').prop("checked", false);
    $('.allemployee').prop("checked", true);
    }
  });

  $('input[name="secondCat"]').change(function () {
    const val = $(this).val()
    if(val == 'allemployee'){
      $('.allstatus').hide();
      $('.thirdDiv').hide();
      unCheckDepartments()
      unCheckItemName()
    }else if(val == 'bydepartment'){
      $('.allstatus').show();
      $('.thirdDiv').show();

    }
  })
  $('input[name="alldepartment"]').change(function () {
    if ($(this).is(":checked")) {
      $('input[name="departmentlist[]"]').prop("checked", true);
    }else{
      $('input[name="departmentlist[]"]').prop("checked", false);

    }

  })
  $('input[name="venue"]').on('input', function() {
    var date = $('#meeting-form').find('input[name="meetingdate"]').val();
  //  var duration = $('#meeting-form').find('select[name="duration"]').val();
        getVenue(date)

  })
  $('input[name="meetingdate"]').on('input', function() {
    var date = $('#meeting-form').find('input[name="meetingdate"]').val();
  //  var duration = $('#meeting-form').find('select[name="duration"]').val();
        getVenue(date)

  })

  $('select[name="duration"]').on('input', function() {
    var date = $('#meeting-form').find('input[name="meetingdate"]').val();
  //  var duration = $('#meeting-form').find('select[name="duration"]').val();
        getVenue(date)

  })

  
  function unCheckDepartments(){
    $('input[name="alldepartment"]').prop("checked", false);
    $('input[name="departmentlist[]"]').prop("checked", false);
  }

  function unCheckItemName(){
    $('input[name="itemname[]"]').prop("checked", false);
  }

  function unCheckCampus(){
    $('input[name="campus[]"]').prop("checked", false);
  }
 
  $(document).on("click", ".btn-edit-meeting" , function(e) {
    e.preventDefault();
    const id = $(this).data('id')
    getInfo(id)
    $('#meetingModal').modal('show')
  })
  $(document).on("submit", "#meeting-form" , function(e) {
    e.preventDefault();
    $.ajax({
        url:  '/meeting/store',
        type: 'post',
        data: $('#meeting-form').serialize(),
        beforeSend:function(){
          $('#meeting-form').find('small').text('');
          $('#meeting-form').find('input').removeClass('is-invalid');
          $('#meeting-form').find('select').removeClass('is-invalid');
        },
        success:function(data){
            if(data.status === 200){
              $('#meetingModal').modal('hide')
              $('#meeting-table').DataTable().ajax.reload();
               $('.alertmessage').append('<div class="alert alert-success-faded" role="alert">Save Successfully!</div>')
            }else if(data.status === 400){
                    $.each(data.message, function(prefix,val){
                        $('#meeting-form').find('input[name="'+prefix+'"]').addClass('is-invalid');
                        $('#meeting-form').find('select[name="'+prefix+'"]').addClass('is-invalid');
                         $('#meeting-form').find('small.'+prefix+'_error').text(val[0]);
                    });
            }else if(data.status === 401){
              $('.alertmessage').append('<div class="alert alert-danger-faded" role="alert">'+data.message+'!</div>')
            } 
            $('.alert').delay(3000).fadeOut();
        }
  
    });
  });


  $('#meeting-table').DataTable({
    processing: true,
    //info: true,
    responsive : true,
    ordering: false,
    "ajax" :{
        "url" : "/meeting/list",
          "type" : "POST",
          error: function (xhr, error, code) {
                console.log(xhr, code);
            }
          },
     "pageLength": 10,
     "aLengthMenu":[[10,25,50,100,-1],[10,25,50,100,'All']],
      columns: [
        {data: 'id', name: 'id'},
        {data: 'description', name: 'description'},
        {data: 'topic', name: 'topic'},
        {data: 'date', name: 'date'},
        {data: 'timestart', name: 'timestart'},
        {data: 'type', name: 'type'},
        {data: 'venue', name: 'venue'},
        // {data: 'addedby', name: 'addedby'},
        {data: 'action', name: 'action'},
        ],
        error: function(err) {
            if(err.status === 500){
                toastr.error('Server is Offline')  
            }
          }
   // "initComplete": isComplete,
  });

  function getInfo(id){
    $.ajax({
      url: '/meeting/one',
      type: 'post',
      data: {
            id
        },
      dataType: 'json',
      beforeSend:function(){
        $('#meeting-form')[0].reset();
         // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
      },
      success:function(result){
        console.log(result);
          if(result.status == 200){
            $('#meeting-form').find('input[name="id"]').val(result.data.id);
            $('#meeting-form').find('input[name="description"]').val(result.data.description);
            $('#meeting-form').find('input[name="topic"]').val(result.data.topic);
            $('#meeting-form').find('select[name="meetingtype"]').val(result.data.type).change();
            $('#meeting-form').find('input[name="meetingdate"]').val(result.data.date);
            $('#meeting-form').find('input[name="timestart"]').val(result.data.timestart);
            $('#meeting-form').find('input[name="timend"]').val(result.data.timend);
            $('#meeting-form').find('select[name="duration"]').val(result.data.duration).change();
            $('#meeting-form').find('input[name="venue"]').val(result.data.venue);
            $('#meeting-form').find('input[name="link"]').val(result.data.link);
          }else{
            alert(result.message)
          }
      }
    })
  }

  function getVenue(date,duration){
    if(isVenueType){
    $.ajax({
      url: '/meeting/getvenue',
      type: 'post',
      data: {
        date
        },
      dataType: 'json',
      beforeSend:function(){
       // $('#meeting-form')[0].reset();
         // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
      },
      success:function(result){
       console.log('venue:',result);
      if(result.status == 200){
        $('.venueReserved').html('')
        result.data.forEach(function(item) {
          if(item.venue){
            $('.venueReserved').html(' <h6 class="text-info mt-2">Venue Reserved List')
            $('.venueReserved').append('<div class="text-danger">\
            <span><i class="ri-map-pin-2-line"></i> '+item.venue+' <i> <small class="text-danger"> : '+item.timestart+'-'+item.timend+' </small> </i> </span>\
          </div>');
          }
          
       });
       
      }
       
      }
    })
    }
  }
  $(document).on("click", ".btn-delete-meeting" , function(e) {
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
          url: '/meeting/delete',
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
                $('#meeting-table').DataTable().ajax.reload();
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




})



