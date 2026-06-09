@extends('components.dashmaster')
@section('body')

<style>
/* Enhanced Teacher Dashboard Styling */
.teacher-dashboard {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 0;
}

.dashboard-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    padding: 30px 0;
    margin-bottom: 30px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

/* Page header styles for consistency */
.page-header {
    background: white;
    padding: 20px 30px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.page-title i {
    color: #28a745;
}

.page-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

.breadcrumb-custom {
    background: transparent;
    margin-bottom: 0;
    padding: 0;
}

.enhanced-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--card-color, #6c757d);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.stat-card.subjects {
    --card-color: #3498db;
    --card-color-dark: #2980b9;
}

.stat-card.assignments {
    --card-color: #2ecc71;
    --card-color-dark: #27ae60;
}

.stat-card.students {
    --card-color: #f39c12;
    --card-color-dark: #e67e22;
}

.stat-card.quizzes {
    --card-color: #e74c3c;
    --card-color-dark: #c0392b;
}

.stat-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    background: var(--card-color);
    margin-right: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.stat-info h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 5px 0;
    color: #2c3e50;
}

.stat-info p {
    font-size: 1rem;
    color: #7f8c8d;
    margin: 0;
    font-weight: 500;
}

.stat-link {
    display: inline-flex;
    align-items: center;
    color: var(--card-color);
    text-decoration: none;
    font-weight: 600;
    margin-top: 15px;
    padding: 8px 15px;
    border-radius: 25px;
    background: rgba(var(--card-color-rgb, 102, 126, 234), 0.1);
    transition: all 0.3s ease;
}

.stat-link:hover {
    background: var(--card-color);
    color: white;
    text-decoration: none;
    transform: translateX(5px);
}

.stat-link i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.stat-link:hover i {
    transform: translateX(3px);
}

.schools-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
}

.schools-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
}

.schools-title i {
    margin-right: 12px;
    color: #6c757d;
}

.schools-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.school-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border-left: 4px solid var(--school-color, #6c757d);
    border: 1px solid #f1f3f4;
}

.school-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
}

.school-name {
    font-size: 1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.school-count {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--school-color);
    margin: 0;
}

.dashboard-content {
    background: white;
    border-radius: 15px;
    margin-bottom: 30px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
}

.content-section {
    background: white;
    border-radius: 15px;
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid #e9ecef;
}

.section-header {
    background: #f8f9fa;
    color: #2c3e50;
    padding: 20px 30px;
    font-size: 1.2rem;
    font-weight: 600;
    border-bottom: 1px solid #e9ecef;
}

.section-body {
    padding: 25px 30px;
}

@media (max-width: 768px) {
    .enhanced-stats {
        grid-template-columns: 1fr;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .schools-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    }
}

/* Map enhancements */
#world-map {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

/* Calendar enhancements */
#calendar {
    border-radius: 15px;
    overflow: hidden;
}

.fc-event {
    border-radius: 8px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper teacher-dashboard">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
      <div class="container-fluid">
        <div class="page-header">
          <div>
            <h1 class="page-title">
              <i class="fas fa-tachometer-alt me-2"></i>
              Teacher Dashboard
            </h1>
            <p class="page-description" style="margin:0;">Welcome back, {{ $teacher->firstname }}! Here's your teaching overview for today</p>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Overview</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Enhanced Statistics Cards -->
        <div class="enhanced-stats">
          <div class="stat-card subjects">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-book"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $totalSubjects }}</h3>
                <p>Subjects Assigned</p>
              </div>
            </div>
            <a href="{{route('teacher.classes')}}" class="stat-link">
              View Subjects <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card assignments">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-tasks"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $totalAssignments }}</h3>
                <p>Active Assignments</p>
              </div>
            </div>
            <a href="{{route('teacher.assignments')}}" class="stat-link">
              Manage Assignments <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card students">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-users"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $totalStudents }}</h3>
                <p>Total Students</p>
              </div>
            </div>
            <a href="{{route('teacher.users')}}" class="stat-link">
              View Students <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card quizzes">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-question-circle"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $totalQuizzes }}</h3>
                <p>Total Quizzes</p>
              </div>
            </div>
            <a href="{{route('quizzes.index')}}" class="stat-link">
              Manage Quizzes <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Schools Statistics Section -->
        @if(count($schoolStats) > 0)
        <div class="schools-section">
          <h2 class="schools-title">
            <i class="fas fa-school"></i>
            Students by School
          </h2>
          <div class="schools-grid">
            @foreach($schoolStats as $school)
              <div class="school-card" style="--school-color: {{ $school['color'] === 'bg-primary' ? '#3498db' : ($school['color'] === 'bg-success' ? '#2ecc71' : ($school['color'] === 'bg-warning' ? '#f39c12' : ($school['color'] === 'bg-danger' ? '#e74c3c' : '#6c757d'))) }}">
                <div class="school-name">{{ $school['name'] }}</div>
                <h3 class="school-count">{{ $school['count'] }}</h3>
              </div>
            @endforeach
          </div>
        </div>
        @endif
        <!-- Content Sections -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6">
            <!-- Enhanced Calendar Card -->
            <div class="content-section">
              <div class="section-header">
                <i class="far fa-calendar-alt"></i>
                Academic Calendar
              </div>
              <div class="section-body">
                <!-- The calendar -->
                <div id="calendar" style="width: 100%; height: 350px;"></div>
              </div>
            </div>
          </section>
          
          <!-- Right col -->
          <section class="col-lg-6">
            <!-- Enhanced Map Card -->
            <div class="content-section">
              <div class="section-header">
                <i class="fas fa-map-marker-alt"></i>
                Schools Location Map
              </div>
              <div class="section-body">
                <div id="world-map" style="height: 350px; width: 100%;">
                  {{-- Leaflet map will be rendered here --}}
                </div>
              </div>
            </div>
          </section>
        </div>

        <!-- Additional Quick Actions Section -->
        <div class="content-section">
          <div class="section-header">
            <i class="fas fa-bolt"></i>
            Quick Actions
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{route('teacher.classes')}}" class="btn btn-outline-primary btn-block btn-lg">
                  <i class="fas fa-chalkboard"></i><br>
                  Manage Classes
                </a>
              </div>
              <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{route('teacher.assignments')}}" class="btn btn-outline-success btn-block btn-lg">
                  <i class="fas fa-clipboard-list"></i><br>
                  Create Assignment
                </a>
              </div>
              <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{route('quizzes.index')}}" class="btn btn-outline-warning btn-block btn-lg">
                  <i class="fas fa-question-circle"></i><br>
                  Manage Quizzes
                </a>
              </div>
              <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{route('teacher.users')}}" class="btn btn-outline-info btn-block btn-lg">
                  <i class="fas fa-users"></i><br>
                  View Students
                </a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <footer class="main-footer" style="background: white; border-top: 1px solid #e9ecef;">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz" style="color: #007bff;">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b style="color: #6c757d;"></b> v2.0 --}}
    </div>
</footer>

<script>
    // Get the current year and display it in the footer
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced animations and interactions
    document.addEventListener('DOMContentLoaded', function () {
        // Animate statistics cards on load
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 200);
        });

        // Animate school cards
        const schoolCards = document.querySelectorAll('.school-card');
        schoolCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 800 + (index * 100));
        });

        // Enhanced Calendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            selectable: true,
            editable: true,
            events: [
                {
                    title: 'Mathematics Quiz',
                    start: new Date().toISOString().split('T')[0],
                    color: '#3498db'
                },
                {
                    title: 'Assignment Due',
                    start: new Date(Date.now() + 86400000).toISOString().split('T')[0],
                    color: '#e74c3c'
                }
            ],
            dateClick: function(info) {
                Swal.fire({
                    title: 'Schedule Event',
                    text: 'Would you like to schedule an event for ' + info.dateStr + '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#6c757d'
                });
            },
            eventClick: function(info) {
                Swal.fire({
                    title: info.event.title,
                    text: 'Event scheduled for ' + info.event.startStr,
                    icon: 'info',
                    confirmButtonColor: '#007bff'
                });
            }
        });
        calendar.render();

        // Enhanced Map with dynamic school markers
        var map = L.map('world-map').setView([-6.7924, 39.2083], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add dynamic school markers
        @if(count($schoolStats) > 0)
            @foreach($schoolStats as $school)
                @php
                    $coords = [
                        'Jitegemee Secondary School' => [-6.7924, 39.2083],
                        'Kawawa Secondary School' => [-7.676, 35.6864],
                        'Makongo Secondary School' => [-6.8000, 39.2800],
                        'Kikaro secondar School' => [-6.7500, 39.2500],
                        'Jitegemee' => [-6.7924, 39.2083],
                        'Kawawa' => [-7.676, 35.6864],
                        'Makongo' => [-6.8000, 39.2800]
                    ];
                    $schoolCoords = $coords[$school['name']] ?? [-6.7924, 39.2083];
                @endphp

                var marker{{ $loop->index }} = L.marker([{{ $schoolCoords[0] }}, {{ $schoolCoords[1] }}]).addTo(map);
                marker{{ $loop->index }}.bindPopup('<b>{{ $school['name'] }}</b><br>{{ $school['count'] }} Students');
            @endforeach
        @endif

        // Add welcome animation
        setTimeout(() => {
            const welcomeTitle = document.querySelector('.welcome-title');
            if (welcomeTitle) {
                welcomeTitle.style.animation = 'fadeInDown 1s ease';
            }
        }, 100);

        // Add counter animation for statistics
        const counters = document.querySelectorAll('.stat-info h3');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            counter.textContent = '0';
            
            setTimeout(() => {
                let count = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    count += increment;
                    counter.textContent = Math.floor(count);
                    if (count >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    }
                }, 40);
            }, 1000);
        });

        // Welcome message
        setTimeout(() => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

           
        }, 2000);
    });

    // Add custom CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .quick-action-btn:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
    `;
    document.head.appendChild(style);
</script>

<!-- SweetAlert2 for enhanced notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>


@endsection



{{-- @extends('components.dashmaster')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h1 class="h2">Teacher Dashboard</h1>
     
    </div> 

    <section class="container-fluid my-5">
        <div class="row g-3">
    
            <!-- Welcome Message -->
            <div class="col-12">
                <div class="welcome-message bg-light p-4 rounded">
                    <h1>Welcome, {{ $teacher->name }}!</h1>
                    <p>We're glad to have you back.</p>
                </div>
            </div>
    
            <!-- Statistics Cards -->
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Classes</h5>
                        <p class="card-text">Total Classes:
                             {{-- {{ $classesCount }} -
                            </p>
                        <i class="fa fa-chalkboard fa-2x"></i>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Assignments</h5>
                        <p class="card-text">Pending: 
                            {{-- {{ $pendingAssignments }} 
                        </p>
                        <i class="fa fa-tasks fa-2x"></i>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card text-white bg-warning shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Quizzes</h5>
                        <p class="card-text">Active Quizzes: 
                            {{-- {{ $activeQuizzes }} 
                        </p>
                        <i class="fa fa-question-circle fa-2x"></i>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Students</h5>
                        <p class="card-text">Total Students: 
                            {{-- {{ $studentsCount }} 
                        </p>
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
    
        </div>
    </section>
@endsection 




 --}}
