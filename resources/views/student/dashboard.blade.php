
@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1 class="dashboard-title">
            <i class="fas fa-graduation-cap text-primary"></i>
            Student Dashboard
          </h1>
          <p class="text-muted">Track your academic progress and access learning resources</p>
        </div>
        <div class="col-sm-4">
          <div class="text-right">
            <span class="badge badge-lg badge-primary px-3 py-2">
              <i class="fas fa-school"></i>
              @if($student->schoolClass)
                {{ $student->schoolClass->name }}
              @else
                No Class Assigned
              @endif
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
      <!-- Welcome Section -->
      <div class="welcome-section mb-4">
        <div class="welcome-card">
          <div class="welcome-content">
            <div class="welcome-text">
              <h2 class="welcome-title">
                <i class="fas fa-wave-square text-primary"></i>
                Welcome back, {{ explode(' ', $student->name)[0] }}!
              </h2>
              <p class="welcome-subtitle">Ready to continue your learning journey?</p>
              @if($student->schoolClass)
                <div class="class-info">
                  <i class="fas fa-users text-muted"></i>
                  <span>{{ $student->schoolClass->name }}</span>
                </div>
              @endif
            </div>
            <div class="welcome-icon">
              <i class="fas fa-user-graduate"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="stats-section">
        <div class="stats-grid">
          
          <div class="stat-card subjects">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-book-open"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $totalSubjects }}</h3>
                <p>My Subjects</p>
              </div>
            </div>
            <a href="{{route('student.class')}}" class="stat-link">
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
                <p>Pending Assignments</p>
              </div>
            </div>
            <a href="{{route('student.assignments')}}" class="stat-link">
              View Assignments <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card quizzes">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-question-circle"></i>
              </div>
              <div class="stat-info">
                <h3>{{ $totalQuizzes }}</h3>
                <p>Available Quizzes</p>
              </div>
            </div>
            <a href="{{route('student.quizzes')}}" class="stat-link">
              Take Quizzes <i class="fas fa-arrow-right"></i>
            </a>
          </div>

          <div class="stat-card activities">
            <div class="stat-header">
              <div class="stat-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stat-info">
                <h3>{{ date('H') }}</h3>
                <p>Study Hours Today</p>
              </div>
            </div>
            <a href="#" class="stat-link">
              View Activity <i class="fas fa-arrow-right"></i>
            </a>
          </div>

        </div>
      </div>

      <!-- Quick Actions Section -->
      <div class="quick-actions-section">
        <h3 class="section-title">
          <i class="fas fa-bolt"></i>
          Quick Actions
        </h3>
        <div class="quick-actions-grid">
          <a href="{{ route('student.class') }}" class="quick-action-btn subjects-action">
            <i class="fas fa-book-reader"></i>
            <span>Study Materials</span>
          </a>
          <a href="{{ route('student.assignments') }}" class="quick-action-btn assignments-action">
            <i class="fas fa-pencil-alt"></i>
            <span>Submit Assignment</span>
          </a>
          <a href="{{ route('student.quizzes') }}" class="quick-action-btn quizzes-action">
            <i class="fas fa-brain"></i>
            <span>Take Quiz</span>
          </a>
          <a href="{{ route('student.blog') }}" class="quick-action-btn blog-action">
            <i class="fas fa-comments"></i>
            <span>Discussion Forum</span>
          </a>
        </div>
      </div>

      <!-- Learning Progress Section -->
      <div class="row mt-4">
        <!-- Academic Calendar -->
        <div class="col-lg-6">
          <div class="calendar-card">
            <div class="calendar-header">
              <h4>
                <i class="far fa-calendar-alt"></i>
                Academic Calendar
              </h4>
              <div class="calendar-controls">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-light dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-bars"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Add Event</a>
                    <a href="#" class="dropdown-item">View All</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="calendar-body">
              <div id="student-calendar" style="width: 100%; height: 300px;"></div>
            </div>
            <div class="calendar-events">
              <h6 class="events-title">
                <i class="fas fa-bell"></i>
                Upcoming Events
              </h6>
              <div class="events-list">
                @forelse($upcomingEvents as $event)
                  <div class="event-item {{ $event['type'] }}">
                    <div class="event-date">
                      <span class="day">{{ $event['date']->format('d') }}</span>
                      <span class="month">{{ $event['date']->format('M') }}</span>
                    </div>
                    <div class="event-details">
                      <h6>{{ $event['title'] }}</h6>
                      <p>{{ $event['description'] }}</p>
                      <small class="text-muted">
                        {{ $event['date']->format('l, F j') }} 
                        @if($event['type'] === 'assignment')
                          at 11:59 PM
                        @else
                          at {{ $event['date']->format('g:i A') }}
                        @endif
                      </small>
                    </div>
                  </div>
                @empty
                  <div class="no-events">
                    <i class="far fa-calendar-alt text-muted"></i>
                    <p class="text-muted mb-0">No upcoming events</p>
                    <small class="text-muted">Check back later for new assignments and quizzes</small>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>

        <!-- Study Progress -->
        <div class="col-lg-6">
          <div class="progress-card">
            <div class="progress-header">
              <h4>
                <i class="fas fa-chart-line"></i>
                Study Progress
              </h4>
            </div>
            <div class="progress-body">
              <div class="subject-progress">
                @forelse($studyProgress as $subject)
                  <div class="subject-item">
                    <div class="subject-info">
                      <span class="subject-name">{{ $subject['name'] }}</span>
                      <span class="subject-percentage">{{ $subject['percentage'] }}%</span>
                    </div>
                    <div class="progress-bar-container">
                      <div class="progress-bar" style="width: {{ $subject['percentage'] }}%"></div>
                    </div>
                  </div>
                @empty
                  <div class="no-subjects">
                    <i class="fas fa-book text-muted"></i>
                    <p>No subjects assigned yet</p>
                    <small class="text-muted">Contact your teacher for subject assignments</small>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- School Location Map Section -->
      <div class="map-section mt-4">
        <h3 class="section-title">
          <i class="fas fa-map-marker-alt"></i>
          School Location
        </h3>
        <div class="map-card">
          <div class="map-header">
            <h4>
              <i class="fas fa-school"></i>
              Schools in Our Network
            </h4>
            <div class="map-controls">
              <button class="btn btn-sm btn-outline-primary">
                <i class="fas fa-expand"></i>
                Full Screen
              </button>
            </div>
          </div>
          <div class="map-body">
            <div id="school-map" style="height: 400px; width: 100%;"></div>
          </div>
          <div class="map-info">
            <div class="school-locations">
              <h6 class="locations-title">
                <i class="fas fa-building"></i>
                School Locations
              </h6>
              <div class="locations-list">
                <div class="location-item">
                  <div class="location-marker jitegemee">
                    <i class="fas fa-map-pin"></i>
                  </div>
                  <div class="location-details">
                    <h6>Jitegemee Secondary School</h6>
                    <p>Dar es Salaam, Tanzania</p>
                    <small class="text-muted">Main Campus - Science & Mathematics</small>
                  </div>
                </div>
                <div class="location-item">
                  <div class="location-marker kawawa">
                    <i class="fas fa-map-pin"></i>
                  </div>
                  <div class="location-details">
                    <h6>Kawawa Secondary School</h6>
                    <p>Iringa, Tanzania</p>
                    <small class="text-muted">Branch Campus - Arts & Humanities</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity Section -->
      <div class="recent-activity-section mt-4">
        <h3 class="section-title">
          <i class="fas fa-history"></i>
          Recent Activity
        </h3>
        <div class="activity-card">
          <div class="activity-list">
            @forelse($recentActivities as $activity)
              <div class="activity-item">
                <div class="activity-icon {{ $activity['type'] === 'assignment' ? 'assignments' : 'quizzes' }}">
                  @if($activity['type'] === 'assignment')
                    <i class="fas fa-upload"></i>
                  @else
                    <i class="fas fa-check-circle"></i>
                  @endif
                </div>
                <div class="activity-content">
                  <h5>{{ $activity['title'] }}</h5>
                  <p>{{ $activity['description'] }}</p>
                  <small class="text-muted">{{ $activity['time']->diffForHumans() }}</small>
                </div>
              </div>
            @empty
              <div class="no-activities">
                <div class="activity-icon subjects">
                  <i class="fas fa-clock"></i>
                </div>
                <div class="activity-content">
                  <h5>No recent activities</h5>
                  <p>Start submitting assignments or taking quizzes to see your activity here</p>
                  <small class="text-muted">Your progress will be tracked automatically</small>
                </div>
              </div>
            @endforelse
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
<!-- Footer -->
<footer class="main-footer" style="background: white; border-top: 1px solid #e9ecef;">
  <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz" style="color: #007bff;">Visit Our Website</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    {{-- <b>Academic Year</b> {{ date('Y') }}/{{ date('Y') + 1 }} --}}
  </div>
</footer>

<!-- Enhanced CSS Styles -->
<style>
/* Dashboard Title */
.dashboard-title {
  color: #2c3e50;
  font-weight: 600;
  margin-bottom: 5px;
}

/* Welcome Section */
.welcome-section {
  margin-bottom: 2rem;
}

.welcome-card {
  background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
  border-radius: 15px;
  padding: 0;
  box-shadow: 0 10px 30px rgba(40, 167, 69, 0.2);
  overflow: hidden;
}

.welcome-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 2rem;
  position: relative;
}

.welcome-text {
  flex: 1;
  color: white;
}

.welcome-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: white;
}

.welcome-subtitle {
  font-size: 1.1rem;
  margin-bottom: 1rem;
  opacity: 0.9;
}

.class-info {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  opacity: 0.8;
}

.welcome-icon {
  font-size: 4rem;
  opacity: 0.2;
  color: white;
}

/* Statistics Section */
.stats-section {
  margin-bottom: 2rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.stat-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #28a745, #20c997);
}

.stat-card.subjects::before { background: linear-gradient(90deg, #4ecdc4, #44a08d); }
.stat-card.assignments::before { background: linear-gradient(90deg, #ffecd2, #fcb69f); }
.stat-card.quizzes::before { background: linear-gradient(90deg, #a8edea, #fed6e3); }
.stat-card.activities::before { background: linear-gradient(90deg, #d299c2, #fef9d7); }

.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.stat-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.stat-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: white;
}

.stat-card.subjects .stat-icon { background: linear-gradient(135deg, #4ecdc4, #44a08d); }
.stat-card.assignments .stat-icon { background: linear-gradient(135deg, #ffecd2, #fcb69f); }
.stat-card.quizzes .stat-icon { background: linear-gradient(135deg, #a8edea, #fed6e3); color: #333; }
.stat-card.activities .stat-icon { background: linear-gradient(135deg, #d299c2, #fef9d7); color: #333; }

.stat-info h3 {
  font-size: 2.5rem;
  font-weight: 700;
  margin: 0;
  color: #2c3e50;
}

.stat-info p {
  color: #6c757d;
  margin: 0;
  font-weight: 500;
}

.stat-link {
  color: #667eea;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.stat-link:hover {
  color: #764ba2;
  text-decoration: none;
}

/* Section Titles */
.section-title {
  color: #2c3e50;
  font-weight: 600;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.section-title i {
  color: #28a745;
}

/* Quick Actions */
.quick-actions-section {
  margin-bottom: 2rem;
}

.quick-actions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
}

.quick-action-btn {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 1.5rem;
  background: white;
  border: 2px solid #e9ecef;
  border-radius: 12px;
  text-decoration: none;
  color: #495057;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.quick-action-btn:hover {
  text-decoration: none;
  color: #495057;
  border-color: #28a745;
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(40, 167, 69, 0.15);
}

.quick-action-btn i {
  font-size: 2rem;
  color: #28a745;
}

.quick-action-btn span {
  font-weight: 500;
}

/* Calendar Card */
.calendar-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}

.calendar-header {
  background: linear-gradient(135deg, #28a745, #20c997);
  color: white;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.calendar-header h4 {
  margin: 0;
  font-weight: 600;
}

.calendar-body {
  padding: 1rem;
}

#student-calendar {
  min-height: 300px;
}

/* FullCalendar customization */
.fc {
  font-size: 0.85rem;
}

.fc-toolbar-title {
  font-size: 1.1rem !important;
  font-weight: 600 !important;
}

.fc-button {
  background: #28a745 !important;
  border-color: #28a745 !important;
  font-size: 0.8rem !important;
}

.fc-button:hover {
  background: #20c997 !important;
  border-color: #20c997 !important;
}

.fc-event {
  border-radius: 4px !important;
  font-size: 0.75rem !important;
}

/* Calendar Events Section */
.calendar-events {
  border-top: 1px solid #e9ecef;
  padding: 1rem;
  max-height: 200px;
  overflow-y: auto;
}

.events-title {
  color: #495057;
  font-weight: 600;
  margin-bottom: 0.75rem;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.events-title i {
  color: #28a745;
}

.events-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.event-item {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  padding: 0.75rem;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid #28a745;
  transition: all 0.3s ease;
}

.event-item:hover {
  background: #e9ecef;
  transform: translateX(3px);
}

.event-item.quiz {
  border-left-color: #28a745;
}

.event-item.assignment {
  border-left-color: #f39c12;
}

.event-item.session {
  border-left-color: #2ecc71;
}

.event-date {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  min-width: 40px;
  flex-shrink: 0;
}

.event-date .day {
  font-size: 1.2rem;
  font-weight: 700;
  color: #2c3e50;
  line-height: 1;
}

.event-date .month {
  font-size: 0.7rem;
  color: #6c757d;
  text-transform: uppercase;
  font-weight: 600;
}

.event-details {
  flex: 1;
}

.event-details h6 {
  margin: 0 0 0.25rem 0;
  color: #2c3e50;
  font-weight: 600;
  font-size: 0.85rem;
}

.event-details p {
  margin: 0 0 0.25rem 0;
  color: #6c757d;
  font-size: 0.8rem;
}

.event-details small {
  font-size: 0.75rem;
}

.no-events, .no-activities {
  text-align: center;
  padding: 1.5rem;
  color: #6c757d;
}

.no-events i, .no-activities i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
  opacity: 0.5;
}

.no-events p, .no-activities h5 {
  margin-bottom: 0.25rem;
}

.no-events small, .no-activities p {
  font-size: 0.8rem;
}

/* Map Section Styles */
.map-section {
  margin-bottom: 2rem;
}

.map-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}

.map-header {
  background: linear-gradient(135deg, #28a745, #20c997);
  color: white;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.map-header h4 {
  margin: 0;
  font-weight: 600;
}

.map-body {
  padding: 0;
}

#school-map {
  border-radius: 0;
}

.map-info {
  border-top: 1px solid #e9ecef;
  padding: 1rem;
}

.locations-title {
  color: #495057;
  font-weight: 600;
  margin-bottom: 0.75rem;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.locations-title i {
  color: #28a745;
}

.locations-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.location-item {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  padding: 0.75rem;
  background: #f8f9fa;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.location-item:hover {
  background: #e9ecef;
  transform: translateX(3px);
}

.location-marker {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  color: white;
  flex-shrink: 0;
}

.location-marker.jitegemee {
  background: linear-gradient(135deg, #28a745, #20c997);
}

.location-marker.kawawa {
  background: linear-gradient(135deg, #2ecc71, #27ae60);
}

.location-details h6 {
  margin: 0 0 0.25rem 0;
  color: #2c3e50;
  font-weight: 600;
  font-size: 0.85rem;
}

.location-details p {
  margin: 0 0 0.25rem 0;
  color: #6c757d;
  font-size: 0.8rem;
}

.location-details small {
  font-size: 0.75rem;
}

/* Custom Leaflet icon styles */
.custom-div-icon {
  background: none !important;
  border: none !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

/* Responsive map adjustments */
@media (max-width: 768px) {
  .locations-list {
    gap: 0.5rem;
  }
  
  .location-item {
    padding: 0.5rem;
  }
  
  #school-map {
    height: 300px !important;
  }
}

/* Progress Card */
.progress-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}

.progress-header {
  background: linear-gradient(135deg, #4ecdc4, #44a08d);
  color: white;
  padding: 1rem;
}

.progress-header h4 {
  margin: 0;
  font-weight: 600;
}

.progress-body {
  padding: 1rem;
}

.subject-progress {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.subject-item {
  padding: 0.75rem;
  background: #f8f9fa;
  border-radius: 8px;
}

.subject-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.subject-name {
  font-weight: 500;
  color: #495057;
}

.subject-percentage {
  font-weight: 600;
  color: #4ecdc4;
}

.progress-bar-container {
  height: 6px;
  background: #e9ecef;
  border-radius: 3px;
  overflow: hidden;
}

.progress-bar {
  height: 100%;
  background: linear-gradient(90deg, #4ecdc4, #44a08d);
  border-radius: 3px;
  transition: width 0.3s ease;
}

.no-subjects {
  text-align: center;
  padding: 2rem;
  color: #6c757d;
}

.no-subjects i {
  font-size: 3rem;
  margin-bottom: 1rem;
}

/* Recent Activity */
.recent-activity-section {
  margin-bottom: 2rem;
}

.activity-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}

.activity-list {
  padding: 1rem;
}

.activity-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1rem;
  border-radius: 8px;
  transition: background 0.3s ease;
}

.activity-item:hover {
  background: #f8f9fa;
}

.activity-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  color: white;
  flex-shrink: 0;
}

.activity-icon.subjects { background: linear-gradient(135deg, #4ecdc4, #44a08d); }
.activity-icon.quizzes { background: linear-gradient(135deg, #a8edea, #fed6e3); color: #333; }
.activity-icon.assignments { background: linear-gradient(135deg, #ffecd2, #fcb69f); color: #333; }

.activity-content h5 {
  margin: 0 0 0.25rem 0;
  color: #2c3e50;
  font-weight: 600;
  font-size: 0.95rem;
}

.activity-content p {
  margin: 0 0 0.25rem 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.activity-content small {
  font-size: 0.8rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .welcome-content {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .welcome-icon {
    font-size: 2.5rem;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .quick-actions-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .quick-actions-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    
    // Initialize student calendar with FullCalendar
    const calendarEl = document.getElementById('student-calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            height: 300,
            selectable: true,
            editable: false,
            events: [
                @foreach($upcomingEvents as $event)
                {
                    title: '{{ $event["title"] }}',
                    start: '{{ $event["date"]->format("Y-m-d") }}',
                    color: '{{ $event["color"] }}',
                    textColor: 'white',
                    description: '{{ $event["description"] }}'
                }@if(!$loop->last),@endif
                @endforeach
            ],
            dateClick: function(info) {
                // Show event details or allow adding new events
                alert('Selected date: ' + info.dateStr);
            },
            eventClick: function(info) {
                // Show event details with description
                const description = info.event.extendedProps.description || 'No additional details';
                alert('Event: ' + info.event.title + '\nDate: ' + info.event.startStr + '\nDetails: ' + description);
            }
        });
        calendar.render();
    }
    
    // Add smooth animations to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    entry.target.style.transition = 'all 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    });
    
    statCards.forEach(card => {
        observer.observe(card);
    });
    
    // Animate progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 1000);
    });
    
    // Add welcome animation
    const welcomeCard = document.querySelector('.welcome-card');
    if (welcomeCard) {
        welcomeCard.style.opacity = '0';
        welcomeCard.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            welcomeCard.style.transition = 'all 0.8s ease';
            welcomeCard.style.opacity = '1';
            welcomeCard.style.transform = 'translateY(0)';
        }, 300);
    }
    
    // Initialize school location map
    const mapEl = document.getElementById('school-map');
    if (mapEl) {
        // Initialize the Leaflet map
        const map = L.map('school-map').setView([-6.7924, 39.2083], 8); // Center on Tanzania
        
        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Add markers for schools
        const jitegemeeMarker = L.marker([-6.7924, 39.2083]).addTo(map);
        jitegemeeMarker.bindPopup(`
            <div style="text-align: center; padding: 10px;">
                <h6 style="margin: 0 0 5px 0; color: #667eea;">Jitegemee Secondary School</h6>
                <p style="margin: 0 0 5px 0; font-size: 0.9rem;">Dar es Salaam, Tanzania</p>
                <small style="color: #6c757d;">Main Campus - Science & Mathematics</small>
            </div>
        `);
        
        const kawawaMarker = L.marker([-7.7645, 35.6929]).addTo(map);
        kawawaMarker.bindPopup(`
            <div style="text-align: center; padding: 10px;">
                <h6 style="margin: 0 0 5px 0; color: #2ecc71;">Kawawa Secondary School</h6>
                <p style="margin: 0 0 5px 0; font-size: 0.9rem;">Iringa, Tanzania</p>
                <small style="color: #6c757d;">Branch Campus - Arts & Humanities</small>
            </div>
        `);
        
        // Custom marker icons
        const jitegemeeIcon = L.divIcon({
            html: '<i class="fas fa-school" style="color: #667eea; font-size: 20px;"></i>',
            iconSize: [30, 30],
            className: 'custom-div-icon'
        });
        
        const kawawaIcon = L.divIcon({
            html: '<i class="fas fa-school" style="color: #2ecc71; font-size: 20px;"></i>',
            iconSize: [30, 30],
            className: 'custom-div-icon'
        });
        
        // Update markers with custom icons
        jitegemeeMarker.setIcon(jitegemeeIcon);
        kawawaMarker.setIcon(kawawaIcon);
    }
});

// Add click effects to quick action buttons
document.addEventListener('click', function(e) {
    if (e.target.closest('.quick-action-btn')) {
        const btn = e.target.closest('.quick-action-btn');
        btn.style.transform = 'translateY(0) scale(0.98)';
        setTimeout(() => {
            btn.style.transform = '';
        }, 150);
    }
});
</script>

<!-- Include FullCalendar for calendar functionality -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

<!-- Include Leaflet for map functionality -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
     crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
        crossorigin=""></script>

@endsection