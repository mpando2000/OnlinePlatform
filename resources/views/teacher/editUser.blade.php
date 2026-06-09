<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Edit User</title>
</head>

<body class="bg-theme">
    
    <div class="container">
        <div class="row px-auto mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow p-3 mt-5 mx-auto text-dark">

                    <h2 class="title my-4">{{$user->name}}</h2>
                    <form action="/teacher/editedUser/{{$user->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input form-group mb-3">
                            <label for="room_name">User Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}" required>
                        </div>
                        <div class="input form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control" required>
                        </div>

                        
                        <div class="input form-group mb-3">
                            <label for="status">Role</label>
                            <input type="text" name="role" id="role" value="{{$user->role}}" class="form-control" required>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="px-3 text-center btn btn-dark border-0 bg-theme btn-block">
                                <span>Save Changes</span>
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                      </div> 
                    </form>
                 
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="/assets/js/app.js"></script>
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
