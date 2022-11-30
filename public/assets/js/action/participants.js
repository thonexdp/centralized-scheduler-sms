$(document).ready(function () {
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });
  var campus = 'mc';
  var department;
  var meetingIdEmployee;
  var meeting_id = $('input[name="meeting_id"]').val();
  var meeting_date = $('input[name="meeting_date"]').val();
  var meeting_duration = $('input[name="meeting_duration"]').val();
  var meeting_start = $('input[name="meeting_start"]').val();
  var meeting_end = $('input[name="meeting_end"]').val();

  $('input[name="checkall"]').change(function () {
    if ($(this).is(":checked")) {
      $('input[name="chkemployee[]"]').prop("checked", true);
    } else {
      $('input[name="chkemployee[]"]').prop("checked", false);

    }
  })

  $('.select-meeting').change(function () {
   const meetingempid = $(this).val();
   meetingIdEmployee  = meetingempid
   $('#participantsemployee-table').DataTable().ajax.reload();

  })

  

  $(document).on("click", ".send-msg", function (e) {
    $('#sendMsgModal').modal('show');
  });

  $(document).on("click", ".cancel-meeting-emp", function (e) {
    const meetingId = $(this).data('meetingid');
    const empid = $(this).data('empid');
    

    swal({
      title: "Are you sure?",
      text: "Cancel this employee for this meeting?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '/meeting/cancel_participants',
            type: 'post',
            cache: false,
            data: {
              empid, meetingId
            },
            dataType: 'json',
            beforeSend: function () {
              // $('#employee-form')[0].reset();
              // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
            },
            success: function (result) {
              if (result.status == 200) {
                swal({
                  title: "Success!",
                  text: result.message,
                  icon: "success",
                  button: "okay!",
                });
                $('#participants-table').DataTable().ajax.reload();
                $('#employeelist-table-participants').DataTable().ajax.reload();
              } else {
                swal({
                  title: "Error",
                  text: result.message,
                  icon: "error",
                  button: "okay!",
                });
              }

            }

          });
        }
      });

 


  })

  

  $(document).on("submit", "#sendsms-form" , function(e) {
    e.preventDefault();
    $.ajax({
        url:  '/participants/send-sms',
        type: 'post',
        data:{meeting_id},
        beforeSend:function(){
          $('.btn-sendsms').html('<i class="spinner-border spinner-border-sm"></i> Sending Mesage... ');
        },
        success:function(data){
          console.log(data);
            if(data.status === 200){
              swal({
                title: "Success!",
                text: data.message,
                icon: "success",
                button: "okay!",
              });
            }
            swal({
              title: "Error!",
              text: data.message,
              icon: "error",
              button: "okay!",
            });
            $('#sendMsgModal').modal('hide');
            $('.btn-sendsms').html('<i class="ri-send-plane-fill"></i> Send Now');

           
        }
  
    });
  });

  $(document).on("click", ".save-participants", function (e) {
    e.preventDefault();
    var arr = [];
    $('input:checkbox[name="chkemployee[]"]:checked').each(function () {
      arr.push($(this).val());
    });



    if (arr.length === 0){
    swal({
      title: "Error",
      text: 'Please select participants First',
      icon: "error",
      button: "okay!",
    });
   }

    $.ajax({
      // url: '/meeting/save_session_participants',
      url: '/meeting/save_participants',
      type: 'post',
      cache: false,
      data: {
        arr, meeting_id
      },
      dataType: 'json',
      beforeSend: function () {
        // $('#employee-form')[0].reset();
        // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
      },
      success: function (result) {
        console.log('result', result);
        $('#participants-table').DataTable().ajax.reload();
        $('#employeelist-table-participants').DataTable().ajax.reload();
      }

    });

  })



  $('.campus-c').change(function () {
    campus = $(this).val()
    $('#employeelist-table-participants').DataTable().ajax.reload();
  });
  $('.status-c').change(function () {
    status = $(this).val()
    $('#employeelist-table-participants').DataTable().ajax.reload();
  });
  $('.department-c').change(function () {
    department = $(this).val()
    $('#employeelist-table-participants').DataTable().ajax.reload();
  });
  $('#employeelist-table-participants').DataTable({
    processing: true,
    //info: true,
    responsive: true,
    ordering: false,
    "ajax": {
      "url": "/employee/customlist",
      "type": "POST",
      "data": function (set) {
        set.campus = 'mc';
        set.status = status;
        set.department = department;
        set.meetingId = meeting_id;
        set.meetingDate = meeting_date;
        set.meetingDuration = meeting_duration;
        set.meeting_start =  meeting_start;
        set.meeting_end = meeting_end;

      },
      error: function (xhr, error, code) {
        console.log(xhr, code);
      }
    },
    "pageLength": 10,
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
    columns: [
      { data: 'chk', name: 'chk' },
      { data: 'name', name: 'name' },
      { data: 'status', name: 'status' },
      { data: 'department', name: 'department' },
       { data: 'conflict', name: 'conflict' },

    ],
    error: function (err) {
      if (err.status === 500) {
        toastr.error('Server is Offline')
      }
    }
    // "initComplete": isComplete,
  });

  $('#participants-table').DataTable({
    processing: true,
    //info: true,
    responsive: true,
    ordering: false,
    "ajax": {
      "url": "/meeting/participants_list",
      "type": "POST",
      "data": function (set) {
        set.meetingid = meeting_id;
      },
      error: function (xhr, error, code) {
        console.log(xhr, code);
      }
    },
    "pageLength": 10,
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
    columns: [
      { data: 'name', name: 'name' },
      { data: 'status', name: 'status' },
      { data: 'department', name: 'department' },
      { data: 'action', name: 'action' }
    ],
    error: function (err) {
      console.log('err:', err);
      if (err.status === 500) {
        toastr.error('Server is Offline')
      }
    }
    // "initComplete": isComplete,
  });
  $('#participantsemployee-table').DataTable({
    processing: true,
    //info: true,
    responsive: true,
    ordering: false,
    "ajax": {
      "url": "/participants/list",
      "type": "POST",
      "data": function (set) {
        set.meetingid = meetingIdEmployee;
      },
      error: function (xhr, error, code) {
        console.log(xhr, code);
      }
    },
    "pageLength": 10,
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
    columns: [
      { data: 'photo', name: 'photo' },
      { data: 'name', name: 'name' },
      { data: 'status', name: 'status' },
      { data: 'time', name: 'time' },
      { data: 'department', name: 'department' },
    ],
    error: function (err) {
      console.log('err:', err);
      if (err.status === 500) {
        toastr.error('Server is Offline')
      }
    }
    // "initComplete": isComplete,
  });
});