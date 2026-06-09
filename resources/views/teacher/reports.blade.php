
@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Reports Page Styling - Matching Other Modern Pages */
.reports-container {
    background: #f4f6f9;
    min-height: 100vh;
    padding: 0;
}

.reports-content {
    padding: 20px 0;
    position: relative;
}

.report-card {
    background: white;
    border-radius: 25px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    border: none;
}

.report-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.report-card-header {
    padding: 25px 30px;
    border: none;
    font-weight: 700;
    font-size: 1.4rem;
    position: relative;
    overflow: hidden;
}

.report-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: inherit;
    opacity: 0.9;
}

.report-card-header h4 {
    margin: 0;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 10px;
}

.report-card-body {
    padding: 35px 30px;
    text-align: center;
}

.report-card-body p {
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 30px;
    line-height: 1.6;
}

.report-btn {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin: 8px;
    min-width: 200px;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.report-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
}

.report-btn.btn-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.report-btn.btn-success:hover {
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

.report-btn.btn-info {
    background: linear-gradient(45deg, #17a2b8, #007bff);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.3);
}

.report-btn.btn-info:hover {
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.4);
}

.report-btn.btn-warning {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
}

.report-btn.btn-warning:hover {
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
}

.report-btn.btn-danger {
    background: linear-gradient(45deg, #dc3545, #e83e8c);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.report-btn.btn-danger:hover {
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

.report-icon {
    width: 20px;
    height: 20px;
    margin-right: 8px;
}

/* Animation Classes */
.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-slideInLeft {
    animation: slideInLeft 0.8s ease-out forwards;
}

.animate-slideInRight {
    animation: slideInRight 0.8s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .report-btn {
        min-width: 180px;
        padding: 12px 25px;
        font-size: 0.9rem;
    }
    
    .report-card-body {
        padding: 25px 20px;
    }
}
</style>

<div class="content-wrapper">
    <div class="reports-container">
        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="reports-content">
            <div class="container-fluid">
                <!-- Single Row Layout for All Report Buttons -->
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="report-card animate-fadeInUp">
                            <div class="report-card-header text-center" style="background: linear-gradient(135deg, #28a745, #20c997) !important; color: white;">
                                <h4>
                                    <i class="fas fa-chart-pie me-3"></i>
                                    All Reports Dashboard
                                </h4>
                            </div>
                            <div class="report-card-body">
                                <p class="mb-4">Access all available reports from a single dashboard - user data, class information, and performance analytics.</p>
                                
                                <!-- All Buttons in Single Row -->
                                <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
                                    <!-- User & Class Reports -->
                                    <a href="{{ route('teacher.user.reports') }}" class="report-btn btn-success">
                                        <i class="fas fa-users report-icon"></i> 
                                        User Reports
                                    </a>
                                    <a href="{{ route('teacher.class.reports') }}" class="report-btn btn-info">
                                        <i class="fas fa-chalkboard report-icon"></i> 
                                        Class Reports
                                    </a>
                                    <!-- Performance Reports -->
                                    <a href="#" class="report-btn btn-warning">
                                        <i class="fas fa-chart-bar report-icon"></i> 
                                        Assessment Reports
                                    </a>
                                    <a href="#" class="report-btn btn-danger">
                                        <i class="fas fa-file-alt report-icon"></i> 
                                        Submission Reports
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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



