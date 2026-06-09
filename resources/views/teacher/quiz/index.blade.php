@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Quiz Management Styling */
.quiz-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.page-header {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 40px 30px;
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
    color: #9b59b6;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-description {
    color: #7f8c8d;
    font-size: 1.2rem;
    margin: 0 0 25px 0;
    position: relative;
    z-index: 1;
}

.action-buttons {
    position: relative;
    z-index: 1;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.create-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.create-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
    color: white;
    text-decoration: none;
}

.create-btn i {
    margin-right: 8px;
    font-size: 1.1rem;
}

.upload-btn {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.upload-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
    color: white;
    text-decoration: none;
}

.upload-btn i {
    margin-right: 8px;
    font-size: 1.1rem;
}

.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.6s ease;
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
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.05;
    z-index: 0;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.stat-card.active {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
}

.stat-card.active::before {
    display: none;
}

.stat-card.scheduled {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
}

.stat-card.completed {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    color: white;
}

.stat-card.draft {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    display: block;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.stat-label {
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    z-index: 1;
    opacity: 0.9;
}

.quiz-list-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
}

.quiz-list-header {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
    color: white;
    padding: 25px 30px;
    border-bottom: none;
}

.quiz-list-title {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.quiz-list-title i {
    margin-right: 12px;
    color: #3498db;
}

.quiz-table-container {
    padding: 0;
    overflow-x: auto;
}

.quiz-table {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
}

.quiz-table thead th {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 18px 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
}

.quiz-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #ecf0f1;
}

.quiz-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.quiz-table tbody tr:last-child {
    border-bottom: none;
}

.quiz-table tbody td {
    padding: 18px 15px;
    vertical-align: middle;
    border: none;
    font-size: 0.95rem;
}

.quiz-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
    margin-bottom: 5px;
}

.quiz-description {
    color: #7f8c8d;
    font-size: 0.9rem;
    line-height: 1.4;
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.subject-badge {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.class-badge {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.time-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.time-label {
    font-size: 0.8rem;
    color: #7f8c8d;
    text-transform: uppercase;
    font-weight: 500;
}

.time-value {
    font-weight: 600;
    color: #2c3e50;
}

.duration-badge {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    font-size: 0.9rem;
}

.duration-badge i {
    margin-right: 6px;
}

.action-buttons-table {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
}

.action-btn {
    padding: 8px 12px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    font-size: 0.85rem;
    border: none;
    cursor: pointer;
    min-width: 80px;
    justify-content: center;
}

.action-btn i {
    margin-right: 5px;
    font-size: 0.9rem;
}

.view-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(39, 174, 96, 0.3);
}

.view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
    color: white;
    text-decoration: none;
}

.edit-btn {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
}

.edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    color: white;
    text-decoration: none;
}

.delete-btn {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
}

.delete-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
    color: white;
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
    display: block;
}

.empty-state h3 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 2rem;
}

.empty-state p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.status-indicator {
    display: inline-flex;
    align-items: center;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}

.status-active {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
}

.status-upcoming {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    color: #856404;
}

.status-ended {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
}

.status-draft {
    background: linear-gradient(135deg, #e2e3e5 0%, #d6d8db 100%);
    color: #383d41;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
        text-align: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .action-buttons {
        justify-content: center;
        width: 100%;
        margin-top: 20px;
    }
    
    .stats-overview {
        grid-template-columns: 1fr;
    }
    
    .quiz-table {
        font-size: 0.85rem;
    }
    
    .quiz-table thead th,
    .quiz-table tbody td {
        padding: 12px 8px;
    }
    
    .action-buttons-table {
        flex-direction: column;
        align-items: center;
    }
    
    .action-btn {
        width: 100%;
        max-width: 120px;
        margin: 2px 0;
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

/* Print styles */
@media print {
    .action-buttons,
    .action-buttons-table,
    footer {
        display: none !important;
    }
    
    .quiz-container {
        background: white !important;
    }
    
    .page-header,
    .quiz-list-container {
        box-shadow: none !important;
        border: 1px solid #ddd;
    }
}

/* Loading states */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<div class="content-wrapper quiz-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-question-circle"></i>
                Quiz Management
            </h1>
            <p class="page-description">
                Create, manage, and monitor all your quizzes in one centralized location
            </p>
            <div class="action-buttons">
                <a href="{{ route('quizzes.create') }}" class="create-btn">
                    <i class="fas fa-plus"></i>
                    Create New Quiz
                </a>
                <a href="{{ route('quizzes.upload') }}" class="upload-btn">
                    <i class="fas fa-upload"></i>
                    Upload Quiz
                </a>
            </div>
        </div>

        @php
            $totalQuizzes = $quizzes->count();
            $activeQuizzes = $quizzes->filter(function($quiz) {
                return now()->between($quiz->start_time, $quiz->end_time);
            })->count();
            $upcomingQuizzes = $quizzes->filter(function($quiz) {
                return $quiz->start_time > now();
            })->count();
            $completedQuizzes = $quizzes->filter(function($quiz) {
                return $quiz->end_time < now();
            })->count();
        @endphp

        <!-- Statistics Overview -->
        @if($totalQuizzes > 0)
            <div class="stats-overview">
                <div class="stat-card">
                    <span class="stat-number">{{ $totalQuizzes }}</span>
                    <span class="stat-label">Total Quizzes</span>
                </div>
                <div class="stat-card active">
                    <span class="stat-number">{{ $activeQuizzes }}</span>
                    <span class="stat-label">Active Now</span>
                </div>
                <div class="stat-card scheduled">
                    <span class="stat-number">{{ $upcomingQuizzes }}</span>
                    <span class="stat-label">Upcoming</span>
                </div>
                <div class="stat-card completed">
                    <span class="stat-number">{{ $completedQuizzes }}</span>
                    <span class="stat-label">Completed</span>
                </div>
            </div>
        @endif

        <!-- Quiz List -->
        <div class="quiz-list-container">
            <div class="quiz-list-header">
                <h2 class="quiz-list-title">
                    <i class="fas fa-list-alt"></i>
                    Quiz List
                </h2>
            </div>
            
            <div class="quiz-table-container">
                @if($quizzes->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-clipboard-question"></i>
                        <h3>No Quizzes Created Yet</h3>
                        <p>Start by creating your first quiz to engage your students with interactive assessments.</p>
                        <a href="{{ route('quizzes.create') }}" class="create-btn">
                            <i class="fas fa-plus"></i>
                            Create Your First Quiz
                        </a>
                    </div>
                @else
                    <table id="quizTable" class="quiz-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-heading"></i> Quiz Details</th>
                                <th><i class="fas fa-users"></i> Class & Subject</th>
                                <th><i class="fas fa-clock"></i> Schedule</th>
                                <th><i class="fas fa-hourglass-half"></i> Duration</th>
                                <th><i class="fas fa-info-circle"></i> Status</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $quiz)
                                @php
                                    $now = now();
                                    $isActive = $now->between($quiz->start_time, $quiz->end_time);
                                    $isUpcoming = $quiz->start_time > $now;
                                    $isEnded = $quiz->end_time < $now;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="quiz-title">{{ $quiz->title }}</div>
                                        <div class="quiz-description" title="{{ $quiz->description }}">
                                            {{ $quiz->description ?? 'No description provided' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: column; gap: 8px;">
                                            <span class="class-badge">{{ $quiz->class->name ?? 'No Class' }}</span>
                                            <span class="subject-badge">{{ $quiz->subject->name ?? 'No Subject' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="time-info">
                                            <div>
                                                <div class="time-label">Start</div>
                                                <div class="time-value">{{ $quiz->start_time->format('M d, Y H:i') }}</div>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <div class="time-label">End</div>
                                                <div class="time-value">{{ $quiz->end_time->format('M d, Y H:i') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="duration-badge">
                                            <i class="fas fa-stopwatch"></i>
                                            {{ $quiz->duration }} min
                                        </span>
                                    </td>
                                    <td>
                                        @if($isActive)
                                            <span class="status-indicator status-active">
                                                <i class="fas fa-play-circle"></i>
                                                Active
                                            </span>
                                        @elseif($isUpcoming)
                                            <span class="status-indicator status-upcoming">
                                                <i class="fas fa-clock"></i>
                                                Upcoming
                                            </span>
                                        @elseif($isEnded)
                                            <span class="status-indicator status-ended">
                                                <i class="fas fa-check-circle"></i>
                                                Ended
                                            </span>
                                        @else
                                            <span class="status-indicator status-draft">
                                                <i class="fas fa-edit"></i>
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons-table">
                                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="action-btn view-btn" title="View Quiz">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>
                                            <a href="{{ route('quizzes.edit', $quiz->id) }}" class="action-btn edit-btn" title="Edit Quiz">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="action-btn delete-btn" title="Delete Quiz"
                                                        onclick="confirmDelete(this, '{{ $quiz->title }}')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
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

    // Initialize enhanced DataTable for quiz table
    @if(!$quizzes->isEmpty())
        $('#quizTable').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[ 2, "desc" ]], // Sort by schedule (newest first)
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "language": {
                "search": "Search quizzes:",
                "lengthMenu": "Show _MENU_ quizzes per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ quizzes",
                "emptyTable": "No quizzes available",
                "zeroRecords": "No matching quizzes found"
            },
            "columnDefs": [
                {
                    "targets": [5], // Actions column
                    "orderable": false,
                    "searchable": false
                },
                {
                    "targets": [4], // Status column
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
                $('#quizTable_wrapper .dataTables_filter input').css({
                    'border-radius': '20px',
                    'border': '2px solid #e9ecef',
                    'padding': '8px 15px',
                    'margin-left': '10px'
                });
                
                $('#quizTable_wrapper .dataTables_length select').css({
                    'border-radius': '20px',
                    'border': '2px solid #e9ecef',
                    'padding': '5px 10px'
                });

                // Style DataTable buttons
                $('#quizTable_wrapper .dt-buttons .btn').addClass('btn-sm').css({
                    'border-radius': '15px',
                    'margin': '0 3px',
                    'font-size': '0.8rem'
                });
            }
        }).buttons().container().appendTo('#quizTable_wrapper .col-md-6:eq(0)');
    @endif

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

    // Enhanced delete confirmation
    window.confirmDelete = function(button, quizTitle) {
        const form = button.closest('form');
        
        Swal.fire({
            title: 'Delete Quiz?',
            html: `
                <div style="text-align: left; margin: 20px 0;">
                    <p><strong>Quiz:</strong> ${quizTitle}</p>
                    <p style="color: #e74c3c; font-weight: 600;">⚠️ This action cannot be undone!</p>
                    <p>Deleting this quiz will:</p>
                    <ul style="text-align: left; color: #7f8c8d;">
                        <li>Remove all quiz questions</li>
                        <li>Delete student results and attempts</li>
                        <li>Remove quiz from all schedules</li>
                    </ul>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: 'Yes, Delete Quiz',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Deleting Quiz...',
                    text: 'Please wait while we remove the quiz.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit the form
                form.submit();
            }
        });
    };

    // Auto-refresh quiz statuses every 30 seconds
    setInterval(function() {
        updateQuizStatuses();
    }, 30000);

    function updateQuizStatuses() {
        const now = new Date();
        
        $('#quizTable tbody tr').each(function() {
            const row = $(this);
            const startTimeText = row.find('td:eq(2) .time-value:first').text();
            const endTimeText = row.find('td:eq(2) .time-value:last').text();
            
            // Parse dates (this is a simplified version)
            // In a real application, you'd want to use proper date parsing
            const startTime = new Date(startTimeText);
            const endTime = new Date(endTimeText);
            
            let statusHtml = '';
            if (now >= startTime && now <= endTime) {
                statusHtml = '<span class="status-indicator status-active"><i class="fas fa-play-circle"></i> Active</span>';
            } else if (now < startTime) {
                statusHtml = '<span class="status-indicator status-upcoming"><i class="fas fa-clock"></i> Upcoming</span>';
            } else if (now > endTime) {
                statusHtml = '<span class="status-indicator status-ended"><i class="fas fa-check-circle"></i> Ended</span>';
            }
            
            if (statusHtml) {
                row.find('td:eq(4)').html(statusHtml);
            }
        });
    }

    // Keyboard shortcuts
    $(document).keydown(function(e) {
        // Ctrl/Cmd + N for new quiz
        if ((e.ctrlKey || e.metaKey) && e.which === 78) {
            e.preventDefault();
            window.location.href = "{{ route('quizzes.create') }}";
        }
        
        // Ctrl/Cmd + U for upload quiz
        if ((e.ctrlKey || e.metaKey) && e.which === 85) {
            e.preventDefault();
            window.location.href = "{{ route('quizzes.upload') }}";
        }
    });

    // Enhanced table row interactions
    $('#quizTable tbody tr').hover(
        function() {
            $(this).addClass('table-hover');
        },
        function() {
            $(this).removeClass('table-hover');
        }
    );

    // Initialize tooltips for better UX
    $('[title]').tooltip({
        placement: 'top',
        trigger: 'hover'
    });

    // Loading animation for page
    $(window).on('load', function() {
        $('.quiz-container').fadeIn(500);
    });

    // Stats counter animation
    $('.stat-number').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());
        
        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 1500,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(countTo);
            }
        });
    });

    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    console.log('✅ Enhanced Quiz Management page loaded successfully!');
    console.log('📊 Total quizzes loaded: {{ $totalQuizzes }}');
    console.log('⌨️  Keyboard shortcuts: Ctrl+N (New Quiz), Ctrl+U (Upload Quiz)');
});

// Success/Error message handling from server
@if(session('success'))
    $(document).ready(function() {
        showNotification('success', 'Success!', '{{ session('success') }}');
    });
@endif

@if(session('error'))
    $(document).ready(function() {
        showNotification('error', 'Error!', '{{ session('error') }}');
    });
@endif
</script>

@endsection
