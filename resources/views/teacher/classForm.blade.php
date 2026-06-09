@extends('components.dashmaster')
<div class="background"></div>
<div class="padding-c" >
{{-- <main>   --}}
    <div class="form-container">
    <h2>Add Class</h2>
    <form method="POST" action="{{route ('teacherStoreClass')}}">
        @csrf
        <input type="text" name="name" placeholder="Class Name" required><br>

        <input type="submit" value="Add">
    </form>
</div>
   {{-- </main> --}}
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
