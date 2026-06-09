@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Admin Dashboard Styling */
.admin-dashboard {
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

.welcome-section {
    text-align: center;
    margin-bottom: 20px;
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: #2c3e50;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.welcome-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 0;
}

.admin-badge {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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

.stat-card.users {
    --card-color: #17a2b8;
}

.stat-card.classes {
    --card-color: #28a745;
}

.stat-card.inactive {
    --card-color: #ffc107;
}

.stat-card.teachers {
    --card-color: #dc3545;
}

.stat-card.students {
    --card-color: #6f42c1;
}

.stat-card.schools {
    --card-color: #fd7e14;
}

.stat-card.assignments {
    --card-color: #20c997;
}

.stat-card.quizzes {
    --card-color: #e83e8c;
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
    background: rgba(var(--card-color-rgb, 108, 117, 125), 0.1);
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

.schools-overview {
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.school-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border-left: 4px solid var(--school-color, #6c757d);
    border: 1px solid #f1f3f4;
}

.school-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.school-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
}

.school-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.school-stat {
    text-align: center;
}

.school-stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--school-color);
    margin: 0;
}

.school-stat-label {
    font-size: 0.85rem;
    color: #6c757d;
    margin: 0;
}

.recent-activity {
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

.user-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f8f9fa;
}

.user-item:last-child {
    border-bottom: none;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
    font-size: 0.9rem;
    margin-right: 15px;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.user-info h6 {
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 3px 0;
    font-size: 0.95rem;
}

.user-info p {
    color: #6c757d;
    font-size: 0.85rem;
    margin: 0;
}

.role-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-left: auto;
}

.role-badge.admin {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
}

.role-badge.teacher {
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
}

.role-badge.student {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 20px;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    transition: all 0.3s ease;
}

.quick-action-btn:hover {
    border-color: var(--action-color, #007bff);
    color: var(--action-color, #007bff);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.quick-action-btn.users-action {
    --action-color: #17a2b8;
}

.quick-action-btn.schools-action {
    --action-color: #28a745;
}

.quick-action-btn.classes-action {
    --action-color: #ffc107;
    color: #856404;
}

.quick-action-btn.reports-action {
    --action-color: #dc3545;
}

@media (max-width: 768px) {
    .enhanced-stats {
        grid-template-columns: 1fr;
    }
    
    .welcome-title {
        font-size: 2rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .schools-grid {
        grid-template-columns: 1fr;
    }
}

/* Map and Calendar enhancements */
#world-map {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

#calendar {
    border-radius: 15px;
    overflow: hidden;
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
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #28a745;
}

.breadcrumb-custom {
    background: transparent;
    margin-bottom: 0;
    padding: 0;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper admin-dashboard">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
      <div class="container-fluid">
        <div class="page-header">
          <div>
            <h1 class="page-title">
              <i class="fas fa-tachometer-alt me-2"></i>
              Admin Dashboard
            </h1>
            <p class="welcome-subtitle" style="margin:0;">System Overview & Management Dashboard</p>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
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
          <div class="stat-card users">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-users"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['usersCount'] }}</h3>
                <p>Total Users</p>
              </div>
            </div>
            <a href="{{route('admin.users')}}" class="stat-link">
              Manage Users <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card students">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['studentsCount'] }}</h3>
                <p>Students</p>
              </div>
            </div>
            <a href="{{route('admin.users')}}" class="stat-link">
              View Students <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card teachers">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-chalkboard-teacher"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['teachersCount'] }}</h3>
                <p>Teachers</p>
              </div>
            </div>
            <a href="{{route('admin.users')}}" class="stat-link">
              View Teachers <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card schools">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-school"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['schoolsCount'] }}</h3>
                <p>Active Schools</p>
              </div>
            </div>
            <a href="{{route('admin.schools.index')}}" class="stat-link">
              Manage Schools <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card classes">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-door-open"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['classCount'] }}</h3>
                <p>Classes</p>
              </div>
            </div>
            <a href="{{route('admin.classes')}}" class="stat-link">
              Manage Classes <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card quizzes">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-question-circle"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['quizzesCount'] ?? 0 }}</h3>
                <p>Quizzes</p>
              </div>
            </div>
            <a href="{{route('admin.quizzes.index')}}" class="stat-link">
              Manage Quizzes <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card inactive">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-user-slash"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $stat['inactiveCount'] }}</h3>
                <p>Inactive Users</p>
              </div>
            </div>
            <a href="{{route('admin.users')}}" class="stat-link">
              Review Inactive <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Schools Overview Section -->
        @if(count($schoolStats) > 0)
        <div class="schools-overview">
          <h2 class="schools-title">
            <i class="fas fa-graduation-cap"></i>
            Schools Overview
          </h2>
          <div class="schools-grid">
            @foreach($schoolStats as $school)
              <div class="school-card" style="--school-color: {{ $loop->index % 4 == 0 ? '#17a2b8' : ($loop->index % 4 == 1 ? '#28a745' : ($loop->index % 4 == 2 ? '#ffc107' : '#dc3545')) }}">
                <div class="school-name">{{ $school['name'] }}</div>
                <div class="school-stats">
                  <div class="school-stat">
                    <h4 class="school-stat-number">{{ $school['students'] }}</h4>
                    <p class="school-stat-label">Students</p>
                  </div>
                  <div class="school-stat">
                    <h4 class="school-stat-number">{{ $school['teachers'] }}</h4>
                    <p class="school-stat-label">Teachers</p>
                  </div>
                  <div class="school-stat">
                    <h4 class="school-stat-number">{{ $school['total'] }}</h4>
                    <p class="school-stat-label">Total</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif
        <!-- Content Sections Row -->
        <div class="row">
          <!-- Recent Activity -->
          <section class="col-lg-6">
            <div class="recent-activity">
              <div class="section-header">
                <i class="fas fa-clock"></i>
                Recent User Registrations
              </div>
              <div class="section-body">
                @if($recentUsers && $recentUsers->count() > 0)
                  @foreach($recentUsers as $user)
                    <div class="user-item">
                      <div class="user-avatar">
                        {{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
                      </div>
                      <div class="user-info">
                        <h6>{{ $user->firstname }} {{ $user->lastname }}</h6>
                        <p>{{ $user->email }} • {{ $user->created_at->diffForHumans() }}</p>
                      </div>
                      <span class="role-badge {{ $user->role }}">{{ ucfirst($user->role) }}</span>
                    </div>
                  @endforeach
                @else
                  <p class="text-muted text-center">No recent registrations</p>
                @endif
                
                <div class="quick-actions">
                  <a href="{{ route('admin.users') }}" class="quick-action-btn users-action">
                    <i class="fas fa-users"></i>
                    All Users
                  </a>
                  <a href="{{ route('admin.schools.index') }}" class="quick-action-btn schools-action">
                    <i class="fas fa-school"></i>
                    Schools
                  </a>
                </div>
              </div>
            </div>
          </section>

          <!-- Enhanced Calendar -->
          <section class="col-lg-6">
            <div class="recent-activity">
              <div class="section-header">
                <i class="far fa-calendar-alt"></i>
                Academic Calendar
              </div>
              <div class="section-body">
                <div id="calendar" style="width: 100%; height: 350px;"></div>
              </div>
            </div>
          </section>
        </div>

        <!-- System Overview Row -->
        <div class="row">
          <!-- Quick Actions -->
          <section class="col-lg-6">
            <div class="recent-activity">
              <div class="section-header">
                <i class="fas fa-bolt"></i>
                Quick Management Actions
              </div>
              <div class="section-body">
                <div class="quick-actions">
                  <a href="{{ route('admin.classes') }}" class="quick-action-btn classes-action">
                    <i class="fas fa-door-open"></i>
                    Manage Classes
                  </a>
                  <a href="{{ route('admin.quizzes.index') }}" class="quick-action-btn reports-action">
                    <i class="fas fa-question-circle"></i>
                    Quizzes
                  </a>
                  <a href="{{ route('admin.report') }}" class="quick-action-btn reports-action">
                    <i class="fas fa-chart-bar"></i>
                    Reports
                  </a>
                </div>
                
                <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                  <h6 style="margin-bottom: 10px; color: #2c3e50;"><i class="fas fa-info-circle"></i> System Status</h6>
                  <p style="margin: 5px 0; font-size: 0.9rem; color: #6c757d;">
                    <strong>Active Users Today:</strong> {{ $stat['activeUsers'] ?? 0 }}
                  </p>
                  <p style="margin: 5px 0; font-size: 0.9rem; color: #6c757d;">
                    <strong>Recent Registrations:</strong> {{ $stat['recentRegistrations'] ?? 0 }}
                  </p>
                  <p style="margin: 5px 0; font-size: 0.9rem; color: #6c757d;">
                    <strong>System Health:</strong> <span style="color: #28a745; font-weight: 600;">Excellent</span>
                  </p>
                </div>
              </div>
            </div>
          </section>
          </section>

          <!-- Enhanced Schools Map -->
          <section class="col-lg-6">
            <div class="recent-activity">
              <div class="section-header">
                <i class="fas fa-map-marker-alt"></i>
                Schools Location Map
              </div>
              <div class="section-body">
                <div id="world-map" style="height: 350px; width: 100%;">
                  {{-- Leaflet map will be rendered here --}}
                </div>
                <div style="margin-top: 15px; text-align: center;">
                  <small class="text-muted">Interactive map showing all registered schools</small>
                </div>
              </div>
            </div>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="background: white; border-top: 1px solid #e9ecef;">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz" style="color: #007bff;">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b style="color: #6c757d;">Enhanced Admin Dashboard</b> v2.0 --}}
    </div>
</footer>

<script>
    // Get the current year and display it in the footer
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced dashboard functionality
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
            }, index * 100);
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
                    title: 'New School Registration',
                    start: new Date().toISOString().split('T')[0],
                    color: '#28a745'
                },
                {
                    title: 'System Maintenance',
                    start: new Date(Date.now() + 86400000).toISOString().split('T')[0],
                    color: '#ffc107'
                },
                {
                    title: 'Teacher Training',
                    start: new Date(Date.now() + 172800000).toISOString().split('T')[0],
                    color: '#17a2b8'
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
                marker{{ $loop->index }}.bindPopup('<b>{{ $school['name'] }}</b><br>Students: {{ $school['students'] }}<br>Teachers: {{ $school['teachers'] }}');
            @endforeach
        @endif

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
            }, 1200);
        });

        // Welcome message for admin
        setTimeout(() => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

    
        }, 2000);

        // Add hover effects to user items
        const userItems = document.querySelectorAll('.user-item');
        userItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(10px)';
                this.style.background = '#f8f9fa';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
                this.style.background = 'transparent';
            });
        });

        console.log('✅ Enhanced Admin Dashboard initialized successfully!');
        console.log(`📊 System Statistics: {{ $stat['usersCount'] }} total users, {{ $stat['schoolsCount'] }} schools`);
    });
</script>

<!-- SweetAlert2 for enhanced notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

    {{-- <section class="container-fluid my-5">
        <div class="row g-3">
    
            <!-- Welcome Message -->
            <div class="col-12">
                <div class="welcome-message bg-light p-4 rounded">
                    <h1>Welcome, Administartor!</h1>
                    <p>We're glad to have you back.</p>
                </div>
            </div>
    
            <!-- Statistics Cards -->
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Total Users:
                            {{$stat['usersCount']}}
                            </p>
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Classes</h5>
                        <p class="card-text">Total Classes: 
                            {{$stat['classesCount']}}
                        </p>
                        <i class="fa fa-chalkboard fa-2x"></i>
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
    </section> --}}

    
    {{-- <section class="containter-fluid my-5">
        <div class="row g-2">
            <div class="col-md-6 px-2">
                <div class="card shadow-sm border-0">
                    <h2 class="card-header bg-light">Recent Registered Teachers</h2>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachersList as $teacher)
                                        <tr>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->created_at->format('d M, y') }}</td>
                                        </tr> 
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2">
                <div class="card shadow-sm border-0">
                    <h2 class="card-header bg-light">Recent registered Students</h2>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Registered</th>
                                    </tr>
                                </thead>
                               <tbody>
                                    @foreach ($studentsList as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->created_at->format('d M, y') }}</td>
                                        </tr> 
                                   @endforeach
                                  
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection


