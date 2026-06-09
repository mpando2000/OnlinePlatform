
@extends('components.dashmaster')


@section('body')
<div class="content-wrapper custom-student">
    <div class="col-12">
            <div class="welcome-message bg-light p-4 rounded">

                <div class="container">
                    <h1>Online Classes</h1><br><br>
                    
                    <h2>Click the button below to join an online tutoring session</h2><br><br>

                    <a href="{{route('teacher.createMeeting')}}" class="btn btn-primary">Join an Online Session</a>
                    
                
                </div>
            </div>
    </div>
</div>
 <footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
 </footer>

<script>
  // footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // calendar js
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          selectable: true,
          editable: true,
          events: '/admin/events', // Endpoint to fetch events (create this if you have event data)
          dateClick: function(info) {
              alert('Date: ' + info.dateStr);
          },
          eventClick: function(info) {
              alert('Event: ' + info.event.title);
          }
      });
      calendar.render();
  });
</script>
@endsection
