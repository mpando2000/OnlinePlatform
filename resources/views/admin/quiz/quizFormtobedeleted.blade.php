@extends('components.dashmaster')

@section('body')
<div class="content-wrapper custom-dashboard">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Upload Quiz aa</h1>
                    </div>
                    <div class="card-body border p-4 rounded">
                        <form action="{{ route('admin.quizzes.upload.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Quiz Title -->
                            <div class="form-group">
                                <label for="title">Quiz Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Quiz Description -->
                            <div class="form-group">
                                <label for="description">Quiz Description</label>
                                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Select Class -->
                            <div class="form-group">
                                <label for="class_id">Select Class</label>
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Subject Dropdown -->
                            <div class="form-group">
                                <label for="subject_id">Select Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control" required>
                                    <option value="">Select Subject</option>
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Quiz File -->
                            <div class="form-group">
                                <label for="quiz_file">Quiz File:</label>
                                <input type="file" class="form-control" id="quiz_file" name="quiz_file" required>
                            </div>

                            <!-- Submit Quiz -->
                            <button type="submit" class="btn btn-success mt-3">Upload Quiz</button>
                        </form>
                    </div>
                </div>
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
    document.getElementById('class_id').addEventListener('change', function() {
        const classId = this.value;
        
        // Fetch subjects based on the selected class
        fetch(`/admin/get-subjects/${classId}`)
            .then(response => response.json())
            .then(data => {
                const subjectSelect = document.getElementById('subject_id');
                subjectSelect.innerHTML = '<option value="">Select Subject</option>'; // Reset the dropdown

                // Populate the subjects dropdown
                data.forEach(subject => {
                    const option = document.createElement('option');
                    option.value = subject.id;
                    option.textContent = subject.name;
                    subjectSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching subjects:', error));
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
@endsection