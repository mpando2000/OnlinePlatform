@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Submissions Review Styling */
.submissions-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.back-navigation {
    margin-bottom: 20px;
    animation: slideInLeft 0.6s ease;
}

.back-btn {
    background: white;
    color: #2c3e50;
    padding: 12px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 2px solid #e9ecef;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    color: #27ae60;
    text-decoration: none;
    border-color: #27ae60;
}

.back-btn i {
    margin-right: 8px;
}

.page-header {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 40px;
    animation: fadeInDown 0.8s ease;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.05;
    z-index: 0;
}

.page-title {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
}

.page-title i {
    margin-right: 15px;
    color: #27ae60;
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-description {
    color: #7f8c8d;
    font-size: 1.2rem;
    margin: 0;
    position: relative;
    z-index: 1;
}

.submissions-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.overview-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    animation: fadeInUp 0.6s ease;
    transition: all 0.3s ease;
}

.overview-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.overview-card.success {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    box-shadow: 0 10px 30px rgba(39, 174, 96, 0.3);
}

.overview-card.success:hover {
    box-shadow: 0 15px 40px rgba(39, 174, 96, 0.4);
}

.overview-card.warning {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    box-shadow: 0 10px 30px rgba(243, 156, 18, 0.3);
}

.overview-card.warning:hover {
    box-shadow: 0 15px 40px rgba(243, 156, 18, 0.4);
}

.overview-card.danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
}

.overview-card.danger:hover {
    box-shadow: 0 15px 40px rgba(231, 76, 60, 0.4);
}

.overview-number {
    font-size: 3rem;
    font-weight: 700;
    display: block;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.overview-label {
    font-size: 1.1rem;
    font-weight: 500;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.assignment-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
    transition: all 0.3s ease;
}

.assignment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.assignment-header {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
    color: white;
    padding: 25px 30px;
    position: relative;
}

.assignment-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.assignment-header h3 i {
    margin-right: 12px;
    color: #3498db;
}

.assignment-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 15px;
    opacity: 0.9;
}

.meta-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.meta-item i {
    margin-right: 5px;
    color: #3498db;
}

.assignment-stats {
    background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
    padding: 20px 30px;
    display: flex;
    justify-content: space-around;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
}

.stat-item {
    flex: 1;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #27ae60;
    display: block;
    margin-bottom: 5px;
}

.stat-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

.submissions-table-container {
    padding: 30px;
    overflow-x: auto;
}

.submissions-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.submissions-table thead th {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
    color: white;
    padding: 18px 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
    border: none;
}

.submissions-table thead th:first-child {
    border-top-left-radius: 12px;
}

.submissions-table thead th:last-child {
    border-top-right-radius: 12px;
}

.submissions-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #ecf0f1;
}

.submissions-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.submissions-table tbody tr:last-child {
    border-bottom: none;
}

.submissions-table tbody td {
    padding: 18px 15px;
    vertical-align: middle;
    border: none;
}

.student-info {
    display: flex;
    align-items: center;
}

.student-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    margin-right: 12px;
    font-size: 1.2rem;
}

.student-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.submission-time {
    color: #27ae60;
    font-weight: 500;
    display: flex;
    flex-direction: column;
}

.submission-time small {
    color: #7f8c8d;
    font-size: 0.8rem;
    margin-top: 2px;
}

.action-btn {
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    margin: 0 3px;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
}

.action-btn i {
    margin-right: 6px;
    font-size: 0.9rem;
}

.download-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(39, 174, 96, 0.3);
}

.download-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
    color: white;
    text-decoration: none;
}

.view-btn {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
}

.view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    color: white;
    text-decoration: none;
}

.grade-btn {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(155, 89, 182, 0.3);
}

.grade-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(155, 89, 182, 0.4);
    color: white;
    text-decoration: none;
}

.no-submissions {
    text-align: center;
    padding: 60px 30px;
    color: #7f8c8d;
}

.no-submissions i {
    font-size: 4rem;
    color: #bdc3c7;
    margin-bottom: 20px;
}

.no-submissions h4 {
    color: #2c3e50;
    margin-bottom: 15px;
}

.no-submissions p {
    font-size: 1.1rem;
    margin: 0;
}

.empty-state {
    text-align: center;
    padding: 80px 30px;
    color: #7f8c8d;
}

.empty-state i {
    font-size: 5rem;
    color: #bdc3c7;
    margin-bottom: 30px;
}

.empty-state h3 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 2rem;
}

.empty-state p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.create-assignment-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.create-assignment-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(39, 174, 96, 0.4);
    color: white;
    text-decoration: none;
}

.create-assignment-btn i {
    margin-right: 10px;
    font-size: 1.2rem;
}

/* Status indicators */
.status-badge {
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    margin-left: 10px;
}

.status-badge i {
    margin-right: 4px;
    font-size: 0.7rem;
}

.status-on-time {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
}

.status-late {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
        text-align: center;
    }
    
    .submissions-overview {
        grid-template-columns: 1fr;
    }
    
    .assignment-stats {
        flex-direction: column;
        gap: 15px;
    }
    
    .submissions-table {
        font-size: 0.9rem;
    }
    
    .submissions-table thead th,
    .submissions-table tbody td {
        padding: 12px 8px;
    }
    
    .action-btn {
        padding: 6px 12px;
        margin: 2px;
        font-size: 0.8rem;
    }
    
    .student-info {
        flex-direction: column;
        text-align: center;
    }
    
    .student-avatar {
        margin-right: 0;
        margin-bottom: 5px;
    }
}

/* Animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Print styles */
@media print {
    .back-navigation,
    .action-btn,
    footer {
        display: none !important;
    }
    
    .submissions-container {
        background: white !important;
    }
    
    .assignment-card {
        break-inside: avoid;
        margin-bottom: 20px;
    }
}
</style>

<div class="content-wrapper submissions-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('teacher.assignments') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Assignments
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-clipboard-check"></i>
                All Submissions Review
            </h1>
            <p class="page-description">
                Review and manage all student submissions across your assignments
            </p>
        </div>

        @php
            $totalSubmissions = $assignmentsWithSubmissions->sum(function($assignment) {
                return $assignment->submissions->count();
            });
            $totalAssignments = $assignmentsWithSubmissions->count();
            $assignmentsWithSubs = $assignmentsWithSubmissions->filter(function($assignment) {
                return $assignment->submissions->isNotEmpty();
            })->count();
            $assignmentsWithoutSubs = $totalAssignments - $assignmentsWithSubs;
        @endphp

        <!-- Overview Statistics -->
        @if($totalAssignments > 0)
            <div class="submissions-overview">
                <div class="overview-card">
                    <span class="overview-number">{{ $totalAssignments }}</span>
                    <span class="overview-label">Total Assignments</span>
                </div>
                <div class="overview-card success">
                    <span class="overview-number">{{ $totalSubmissions }}</span>
                    <span class="overview-label">Total Submissions</span>
                </div>
                <div class="overview-card warning">
                    <span class="overview-number">{{ $assignmentsWithSubs }}</span>
                    <span class="overview-label">With Submissions</span>
                </div>
                <div class="overview-card danger">
                    <span class="overview-number">{{ $assignmentsWithoutSubs }}</span>
                    <span class="overview-label">No Submissions</span>
                </div>
            </div>
        @endif

        <!-- Assignments with Submissions -->
        @forelse($assignmentsWithSubmissions as $assignment)
            <div class="assignment-card">
                <!-- Assignment Header -->
                <div class="assignment-header">
                    <h3>
                        <i class="fas fa-file-alt"></i>
                        {{ $assignment->title }}
                    </h3>
                    <div class="assignment-meta">
                        <div class="meta-item">
                            <i class="fas fa-book"></i>
                            {{ $assignment->subject->name ?? 'Subject not found' }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            {{ $assignment->schoolClass->name ?? 'Class not found' }}
                        </div>
                        @if($assignment->submission_deadline)
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                Due: {{ $assignment->submission_deadline->format('M d, Y H:i') }}
                            </div>
                        @endif
                        <div class="meta-item">
                            <i class="fas fa-calendar-plus"></i>
                            Created: {{ $assignment->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>

                <!-- Assignment Statistics -->
                <div class="assignment-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $assignment->submissions->count() }}</span>
                        <span class="stat-label">Submissions</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" style="color: #3498db;">
                            {{ $assignment->submissions->where('grade', '>', 0)->count() }}
                        </span>
                        <span class="stat-label">Graded</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" style="color: #f39c12;">
                            {{ $assignment->submissions->where('grade', 0)->count() }}
                        </span>
                        <span class="stat-label">Pending</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" style="color: #e74c3c;">
                            {{ $assignment->submission_deadline ? $assignment->submissions->filter(function($sub) use ($assignment) {
                                return $sub->submitted_at > $assignment->submission_deadline;
                            })->count() : 0 }}
                        </span>
                        <span class="stat-label">Late</span>
                    </div>
                </div>

                <!-- Submissions Table -->
                <div class="submissions-table-container">
                    @if($assignment->submissions->isNotEmpty())
                        <table id="submissionsTable-{{ $assignment->id }}" class="submissions-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i> Student</th>
                                    <th><i class="fas fa-calendar"></i> Submitted At</th>
                                    <th><i class="fas fa-star"></i> Grade</th>
                                    <th><i class="fas fa-info-circle"></i> Status</th>
                                    <th><i class="fas fa-cogs"></i> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignment->submissions->sortByDesc('submitted_at') as $submission)
                                    @php
                                        $isLate = $assignment->submission_deadline && $submission->submitted_at > $assignment->submission_deadline;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="student-info">
                                                <div class="student-avatar">
                                                    {{ strtoupper(substr($submission->student->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <div class="student-name">
                                                    {{ $submission->student->name ?? 'Unknown Student' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="submission-time">
                                                <span>{{ $submission->submitted_at->format('M d, Y H:i') }}</span>
                                                <small>{{ $submission->submitted_at->diffForHumans() }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($submission->grade > 0)
                                                <span style="color: #27ae60; font-weight: 600; font-size: 1.1rem;">
                                                    {{ $submission->grade }}/100
                                                </span>
                                            @else
                                                <span style="color: #7f8c8d; font-style: italic;">
                                                    Not graded
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($isLate)
                                                <span class="status-badge status-late">
                                                    <i class="fas fa-clock"></i>
                                                    Late
                                                </span>
                                            @else
                                                <span class="status-badge status-on-time">
                                                    <i class="fas fa-check"></i>
                                                    On Time
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                                <a href="{{ route('submission.download', $submission->id) }}" 
                                                   class="action-btn download-btn" title="Download Submission">
                                                    <i class="fas fa-download"></i>
                                                    Download
                                                </a>
                                                <a href="{{ route('submission.show', $submission->id) }}" 
                                                   class="action-btn view-btn" target="_blank" title="View Submission">
                                                    <i class="fas fa-eye"></i>
                                                    View
                                                </a>
                                                <button class="action-btn grade-btn" 
                                                        onclick="openGradeModal('{{ $submission->id }}', '{{ $submission->student->name }}', '{{ $submission->grade }}')"
                                                        title="Grade Submission">
                                                    <i class="fas fa-star"></i>
                                                    Grade
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="no-submissions">
                            <i class="fas fa-inbox"></i>
                            <h4>No Submissions Yet</h4>
                            <p>Students haven't submitted any work for this assignment yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Assignments Found</h3>
                <p>You haven't created any assignments yet. Create your first assignment to start receiving submissions.</p>
                <a href="/addAssignment" class="create-assignment-btn">
                    <i class="fas fa-plus"></i>
                    Create Your First Assignment
                </a>
            </div>
        @endforelse
    </div>
</div>

<!-- Grade Modal (placeholder for future implementation) -->
<div id="gradeModal" style="display: none;">
    <!-- Grade modal content would go here -->
</div>



<!-- ./wrapper -->

 <footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Enhanced Page Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize enhanced DataTables for all assignment submission tables
    @foreach($assignmentsWithSubmissions as $assignment)
        @if($assignment->submissions->isNotEmpty())
            $('#submissionsTable-{{ $assignment->id }}').DataTable({
                "pageLength": 10,
                "responsive": true,
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "info": true,
                "autoWidth": false,
                "order": [[ 1, "desc" ]], // Sort by submission date (newest first)
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "language": {
                    "search": "Search submissions:",
                    "lengthMenu": "Show _MENU_ submissions per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ submissions",
                    "emptyTable": "No submissions available for this assignment",
                    "zeroRecords": "No matching submissions found"
                },
                "columnDefs": [
                    {
                        "targets": [4], // Actions column
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        "targets": [3], // Status column
                        "orderable": true,
                        "searchable": true
                    }
                ],
                "dom": '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
                       '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6">>' +
                       '<"row"<"col-sm-12"tr>>' +
                       '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "initComplete": function() {
                    // Add custom styling after table initialization
                    $('#submissionsTable-{{ $assignment->id }}_wrapper .dataTables_filter input').css({
                        'border-radius': '20px',
                        'border': '2px solid #e9ecef',
                        'padding': '8px 15px',
                        'margin-left': '10px'
                    });
                    
                    $('#submissionsTable-{{ $assignment->id }}_wrapper .dataTables_length select').css({
                        'border-radius': '20px',
                        'border': '2px solid #e9ecef',
                        'padding': '5px 10px'
                    });
                }
            }).buttons().container().appendTo('#submissionsTable-{{ $assignment->id }}_wrapper .col-md-6:eq(0)');
        @endif
    @endforeach

    // Enhanced notification system
    function showNotification(type, title, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: type,
            title: title,
            text: message
        });
    }

    // Grade submission modal functionality
    window.openGradeModal = function(submissionId, studentName, currentGrade) {
        Swal.fire({
            title: `Grade Submission`,
            html: `
                <div style="text-align: left; margin-bottom: 20px;">
                    <p><strong>Student:</strong> ${studentName}</p>
                    <p><strong>Current Grade:</strong> ${currentGrade > 0 ? currentGrade + '/100' : 'Not graded'}</p>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="grade-input" style="display: block; margin-bottom: 5px; font-weight: 600;">Grade (0-100):</label>
                    <input type="number" id="grade-input" class="swal2-input" placeholder="Enter grade" 
                           min="0" max="100" value="${currentGrade > 0 ? currentGrade : ''}" 
                           style="text-align: center; font-size: 1.2rem;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="feedback-input" style="display: block; margin-bottom: 5px; font-weight: 600;">Feedback (Optional):</label>
                    <textarea id="feedback-input" class="swal2-textarea" placeholder="Add feedback for the student..." 
                              rows="4" style="resize: vertical; width: 100%;"></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Save Grade',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#27ae60',
            cancelButtonColor: '#95a5a6',
            width: '500px',
            preConfirm: () => {
                const grade = document.getElementById('grade-input').value;
                const feedback = document.getElementById('feedback-input').value;
                
                if (!grade || grade < 0 || grade > 100) {
                    Swal.showValidationMessage('Please enter a valid grade between 0 and 100');
                    return false;
                }
                
                return { grade: grade, feedback: feedback };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to save the grade
                saveGradeToDatabase(submissionId, result.value.grade, result.value.feedback, studentName);
            }
        });
    };

    // Function to save grade to database
    function saveGradeToDatabase(submissionId, grade, feedback, studentName) {
        // Show loading state
        Swal.fire({
            title: 'Saving Grade...',
            text: 'Please wait while we save the grade.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        // Send AJAX request
        $.ajax({
            url: `/submissions/${submissionId}/grade`,
            method: 'POST',
            data: {
                grade: grade,
                feedback: feedback
            },
            success: function(response) {
                Swal.close();
                showNotification('success', 'Grade Saved!', `Grade of ${grade}/100 has been saved for ${studentName}`);
                
                // Update the grade in the table
                updateGradeInTable(submissionId, grade);
                
                // Update statistics if needed
                updateStatistics();
            },
            error: function(xhr, status, error) {
                Swal.close();
                let errorMessage = 'Failed to save grade. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showNotification('error', 'Save Failed', errorMessage);
            }
        });
    }

    // Function to update grade in the table after saving
    function updateGradeInTable(submissionId, grade) {
        // Find the submission row and update the grade column
        $('button[onclick*="' + submissionId + '"]').closest('tr').find('td:eq(2)').html(
            `<span style="color: #27ae60; font-weight: 600; font-size: 1.1rem;">${grade}/100</span>`
        );
    }

    // Function to update statistics after grading
    function updateStatistics() {
        // Update the assignment statistics dynamically
        $('.assignment-card').each(function() {
            const assignmentCard = $(this);
            const submissionsCount = assignmentCard.find('tbody tr').length;
            const gradedCount = assignmentCard.find('tbody tr').filter(function() {
                return $(this).find('td:eq(2)').text().includes('/100');
            }).length;
            const pendingCount = submissionsCount - gradedCount;

            // Update the statistics in the card
            assignmentCard.find('.stat-item:eq(0) .stat-number').text(submissionsCount);
            assignmentCard.find('.stat-item:eq(1) .stat-number').text(gradedCount);
            assignmentCard.find('.stat-item:eq(2) .stat-number').text(pendingCount);
        });

        // Update overview statistics
        let totalSubmissions = 0;
        let totalGraded = 0;
        $('.assignment-card').each(function() {
            const card = $(this);
            totalSubmissions += parseInt(card.find('.stat-item:eq(0) .stat-number').text()) || 0;
            totalGraded += parseInt(card.find('.stat-item:eq(1) .stat-number').text()) || 0;
        });

        // Update overview cards if they exist
        if ($('.overview-card.success').length) {
            $('.overview-card.success .overview-number').text(totalSubmissions);
        }
    }

    // Enhanced download functionality with progress indication
    $(document).on('click', '.download-btn', function(e) {
        const btn = $(this);
        const originalText = btn.html();
        
        // Show loading state
        btn.html('<i class="fas fa-spinner fa-spin"></i> Downloading...');
        btn.prop('disabled', true);
        
        // Simulate download process
        setTimeout(() => {
            btn.html(originalText);
            btn.prop('disabled', false);
            showNotification('success', 'Download Started', 'The file download has begun');
        }, 1500);
    });

    // Enhanced view functionality
    $(document).on('click', '.view-btn', function(e) {
        showNotification('info', 'Opening Submission', 'The submission will open in a new tab');
    });

    // Keyboard shortcuts
    $(document).keydown(function(e) {
        // Ctrl/Cmd + G for quick grade access
        if ((e.ctrlKey || e.metaKey) && e.which === 71) {
            e.preventDefault();
            const firstGradeBtn = $('.grade-btn:first');
            if (firstGradeBtn.length) {
                firstGradeBtn.click();
            }
        }
        
        // Ctrl/Cmd + B for back navigation
        if ((e.ctrlKey || e.metaKey) && e.which === 66) {
            e.preventDefault();
            window.location.href = "{{ route('teacher.assignments') }}";
        }
    });

    // Initialize tooltips for better UX
    $('[title]').tooltip({
        placement: 'top',
        trigger: 'hover'
    });

    // Smooth animations for card interactions
    $('.assignment-card').hover(
        function() { $(this).addClass('shadow-lg'); },
        function() { $(this).removeClass('shadow-lg'); }
    );

    // Footer and other existing functionality
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    console.log('✅ Enhanced Submissions Review page loaded successfully!');
    console.log('⌨️  Keyboard shortcuts: Ctrl+G (Grade), Ctrl+B (Back)');
});
</script>
@endsection





