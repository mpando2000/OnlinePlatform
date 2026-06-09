@extends('components.dashmaster')


@section('body')
<div class="content-wrapper custom-dashboard">
<h1>{{ $assignment->title }}</h1>
<p>{{ $assignment->description }}</p>
<p>Deadline: {{ $assignment->submission_deadline }}</p>

@if($assignment->submission_deadline > now())
    <form action="{{ route('submissions.store', $assignment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".pdf,.doc,.docx" required>
        <button type="submit">Submit Assignment</button>
    </form>
@else
    <p>You are beyond the deadline!</p>
@endif
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