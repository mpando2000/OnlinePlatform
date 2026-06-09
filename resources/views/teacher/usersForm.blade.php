{{-- @extends('components.dashmaster') --}}
 <x-layout />
@include('partials.header')
<div class="background">
</div>
<div id="log">
    <p >
           <b> WELCOME TO SUMAJKT eLEARNING MANAGEMENT SYSTEM </b>
    </p>
    <div class="form-container">
        <h2>Register a new User</h2>
        <form method="POST" action="{{route ('teacher.addUser')}}">
           
            @csrf
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>
            
            <select name="school" required>
                <option value="" selected disabled>Select School</option>
                <option value="jitegemee">Jitegemee</option>
                <option value="kawawa">Kawawa</option>
            </select><br>

            <select id="role" name="role" required>
                <option value="" selected disabled>Select Role</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
            </select><br>

            <select id="class_id" name="class_id" style="display:none;">
                <option value="" selected disabled>Select Class</option>
                @foreach($school_classes as $school_class)
                <option value="{{ $school_class->id }}">{{ $school_class->name }}</option>
                @endforeach
            </select><br>

            <input type="submit" value="Register">
        </form>
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
    document.getElementById('role').addEventListener('change', function () {
        const classSelect = document.getElementById('class_id');
        if (this.value === 'student') {
            classSelect.style.display = 'block';
            classSelect.setAttribute('required', 'required');
        } else {
            classSelect.style.display = 'none';
            classSelect.removeAttribute('required');
        }
    });
    

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