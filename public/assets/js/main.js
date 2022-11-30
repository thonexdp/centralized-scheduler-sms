

setTimeout(function(){
    $('.alert-msg').fadeOut();
},2000)

$(document).ready(function () {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    })

    $.ajax({
        url: '/meeting/notify-meeting',
        type: 'post',
        dataType: 'json',
        beforeSend:function(){
         // $('#employee-form')[0].reset();
           // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
        },
        success:function(result){
            var currentdate = (new Date()).toISOString().split('T')[0];
             console.log('navbar resilt:',result,currentdate);


           
             var countmsg = 0;
            if(result.status == 200){
                result.data.forEach(element => {
                    if(element.meeting){
                        if(currentdate === element.meeting.date){
                            countmsg++;
                            $('.count-msg').text(countmsg)
                            $('.notifications-meeting-description').html('<div class="alert alert-info" role="alert">\
                            <h6 class="alert-heading"> <b> Meeting Today </b></h6></div>')
                            $('.notifications-meeting-description').append('<div class="alert alert-success" role="alert">\
                            <h6 class="alert-heading"> '+element.meeting.description+'</h6>\
                            <p>'+element.meeting.date+' '+element.meeting.timestart+' '+element.meeting.duration+'</p>\
                            <p>'+(element.meeting.type=="Virtual"?" Link: "+element.meeting.link:("Venue: "+element.meeting.venue))+'</p>\
                        </div>')
                            // $('.notifications-meeting-description').append('<div class="mb-4"> <p class="text-muted small">'+element.meeting.description+'</p> <p class="fs-xs fw-bolder text-muted text-uppercase">'+element.meeting.date+' '+element.meeting.timestart+' '+element.meeting.duration+'</p>\
                            // </div>');
                        }
                    }
                    
                  
                });
               

            }
            // eventsdata = result;
        }

    })


})