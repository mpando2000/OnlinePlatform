@extends('components.dashmaster')


@section('body')
<div class="content-wrapper custom-dashboard">
<main>
    <div class="form-container">

        <form action="{{ route('online_classes.store') }}" method="POST">
            @csrf
            <div>
                <label for="topic">Topic:</label>
                <input type="text" name="topic" required>
            </div>
            <br>
            <div>
                <label for="description">Description (Optional):</label>
                <textarea name="description"></textarea>
            </div>
            <br>
            <div>
                <label for="start_time">Start Time:</label>
                <input type="datetime-local" name="start_time" required>
            </div>
            <br>
            <div>
                <label for="duration">Duration (minutes):</label>
                <input type="number" name="duration" required>
            </div>
            <br>
            <input type="hidden" name="zoom_meeting_id" id="zoom_meeting_id">

            <br>
            <input type="submit" value="Create Online Class">
        </form>
    
    </div>

</main>
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