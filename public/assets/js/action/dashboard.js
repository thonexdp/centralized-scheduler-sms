
            // var today = new Date();
            // var dd = String(today.getDate()).padStart(2, '0');
            // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            // var yyyy = today.getFullYear();
    
            // today = yyyy + '/' + mm + '/' + dd;
    
            // console.log(today);
     var eventsdata;
            $.ajax({
                url: '/meeting/my-meeting',
                type: 'post',
                dataType: 'json',
                beforeSend:function(){
                 // $('#employee-form')[0].reset();
                   // $('.loading-select').html('<i class="spinner-border spinner-border-sm"></i> Loading... ');
                },
                success:function(result){
                     console.log('resilt:',result);
                    if(result.status == 200){
                        eventsdata = result.data;
                    }
                    // eventsdata = result;
                }

            })

            let today = new Date().toISOString().slice(0, 10)

         console.log('today',today)
    
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
      
          var calendar = new FullCalendar.Calendar(calendarEl, {
        //     headerToolbar: {
        //       left: 'prevYear,prev,next,nextYear today',
        //       center: 'title',
        //       right: 'dayGridMonth,dayGridWeek,dayGridDay'
        //     },
        //     initialDate: today,
        //     navLinks: false, // can click day/week names to navigate views
        //     editable: false,
        //     dayMaxEvents: false, // allow "more" link when too many events
        //    // eventColor: '#378006',
        //    // textColor : '#000',

        expandRows: true,
        slotMinTime: '08:00',
        slotMaxTime: '20:00',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth',
        initialDate: today,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
           
           events : eventsdata
            // events: [
            //   {
            //         title: 'Today',
            //         start: today,
            //         textColor : 'lightgreen',
            //   },
            //   {
            //     title: 'All Day Event Meeting',
            //     start: '2022-11-01',
                
            //   },
            //   {
            //     title: 'Lunch',
            //     start: '2022-11-01T08:01:00'
            //   },
            //   {
            //     title: 'Long Event',
            //     start: '2022-11-07',
            //     end: '2022-11-10'
            //   },
            //   {
            //     groupId: 999,
            //     title: 'Repeating Event',
            //     start: '2022-11-09T16:00:00'
            //   },
            //   {
            //     groupId: 999,
            //     title: 'Repeating Event',
            //     start: '2022-11-16T16:00:00'
            //   },
            //   {
            //     title: 'Meeting',
            //     start: '2022-11-12T10:30:00',
            //     end: '2022-11-12T12:30:00'
            //   },
            //   {
            //     title: 'Meeting',
            //     start: '2020-09-12T14:30:00'
            //   },
            //   {
            //     title: 'Happy Hour',
            //     start: '2020-09-12T17:30:00'
            //   },
            //   {
            //     title: 'Dinner',
            //     start: '2020-09-12T20:00:00'
            //   },
            //   {
            //     title: 'Birthday Party',
            //     start: '2020-09-13T07:00:00'
            //   },
            //   {
            //     title: 'Click for Google',
            //     url: 'http://google.com/',
            //     start: '2020-09-28'
            //   }
            // ]
          });
      
          calendar.render();
        });