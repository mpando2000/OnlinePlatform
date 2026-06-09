
@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Admin Quiz Management Styling */
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
    background: linear-gradient(135deg, #667eea, #764ba2);
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

.admin-badge {
    background: linear-gradient(45deg, #dc3545, #e83e8c);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
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
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    animation: fadeInUp 0.8s ease;
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    margin-bottom: 15px;
}

.stat-icon.total { background: linear-gradient(135deg, #667eea, #764ba2); }
.stat-icon.active { background: linear-gradient(135deg, #27ae60, #2ecc71); }
.stat-icon.upcoming { background: linear-gradient(135deg, #f39c12, #e67e22); }
.stat-icon.completed { background: linear-gradient(135deg, #e74c3c, #c0392b); }

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-label {
    color: #7f8c8d;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

.quiz-table-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 1s ease;
    overflow: hidden;
}

.table-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px 30px;
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.enhanced-table {
    margin: 0;
}

.enhanced-table thead th {
    background: #f8f9fa;
    color: #2c3e50;
    font-weight: 600;
    padding: 15px 12px;
    border: none;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.enhanced-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.enhanced-table tbody tr {
    transition: all 0.3s ease;
}

.enhanced-table tbody tr:hover {
    background-color: #f8f9ff;
    transform: scale(1.01);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.quiz-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.quiz-description {
    color: #7f8c8d;
    font-size: 0.85rem;
    margin-top: 3px;
}

.class-subject-badge {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.duration-badge {
    background: linear-gradient(45deg, #f39c12, #e67e22);
    color: white;
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
}

.action-buttons-cell {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.action-btn.view {
    background: linear-gradient(45deg, #17a2b8, #138496);
    box-shadow: 0 3px 10px rgba(23, 162, 184, 0.3);
}

.action-btn.edit {
    background: linear-gradient(45deg, #ffc107, #e0a800);
    box-shadow: 0 3px 10px rgba(255, 193, 7, 0.3);
}

.action-btn.delete {
    background: linear-gradient(45deg, #dc3545, #c82333);
    box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
}

.action-btn:hover {
    transform: translateY(-2px) scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.empty-state {
    text-align: center;
    padding: 60px 30px;
    color: #7f8c8d;
}

.empty-state i {
    font-size: 4rem;
    color: #bdc3c7;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #2c3e50;
    margin-bottom: 15px;
}

/* Animation Classes */
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

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
        flex-direction: column;
        text-align: center;
    }
    
    .action-buttons {
        justify-content: center;
    }
    
    .stats-overview {
        grid-template-columns: 1fr;
    }
    
    .action-buttons-cell {
        flex-direction: column;
        gap: 5px;
    }
}
</style>

<div class="content-wrapper">
    <div class="quiz-container">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-clipboard-list"></i>
                    Admin Quiz Management
                </h1>
                <p class="page-description">
                    Comprehensive quiz management system for administrators - Create, manage, and monitor all quizzes
                </p>
                <div class="admin-badge">
                    <i class="fas fa-user-shield"></i>
                    Administrator Access
                </div>
                <div class="action-buttons mt-3">
                    <a href="{{ route('admin.quizzes.create') }}" class="create-btn">
                        <i class="fas fa-plus"></i>
                        Create Quiz
                    </a>
                    <a href="{{ route('admin.quizzes.upload') }}" class="upload-btn">
                        <i class="fas fa-upload"></i>
                        Upload Quiz
                    </a>
                </div>
            </div>

            <!-- Statistics Overview -->
            <div class="stats-overview">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="stat-number">{{ $quizzes->count() }}</div>
                    <div class="stat-label">Total Quizzes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon active">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <div class="stat-number">{{ $quizzes->where('start_time', '<=', now())->where('end_time', '>=', now())->count() }}</div>
                    <div class="stat-label">Active Quizzes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon upcoming">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ $quizzes->where('start_time', '>', now())->count() }}</div>
                    <div class="stat-label">Upcoming Quizzes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon completed">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $quizzes->where('end_time', '<', now())->count() }}</div>
                    <div class="stat-label">Completed Quizzes</div>
                </div>
            </div>

            <!-- Quiz Table -->
            <div class="quiz-table-card">
                <h2 class="table-header">
                    <i class="fas fa-list-ul me-2"></i>
                    All System Quizzes
                </h2>
                <div class="p-0">
                    @if($quizzes->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-clipboard-question"></i>
                            <h4>No Quizzes Found</h4>
                            <p>There are currently no quizzes in the system. Create your first quiz to get started!</p>
                            <a href="{{ route('admin.quizzes.create') }}" class="create-btn mt-3">
                                <i class="fas fa-plus"></i>
                                Create First Quiz
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table id="quizzesTable" class="table enhanced-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-heading me-1"></i>Quiz Details</th>
                                        <th><i class="fas fa-chalkboard me-1"></i>Class & Subject</th>
                                        <th><i class="fas fa-calendar me-1"></i>Schedule</th>
                                        <th><i class="fas fa-hourglass-half me-1"></i>Duration</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quizzes as $quiz)
                                        <tr>
                                            <td>
                                                <div class="quiz-title">{{ $quiz->title }}</div>
                                                <div class="quiz-description">{{ Str::limit($quiz->description, 50) }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    <span class="class-subject-badge">{{ $quiz->class->name ?? 'N/A' }}</span>
                                                    <small class="text-muted">{{ $quiz->subject->name ?? 'No Subject' }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted small">
                                                    <div><i class="fas fa-play me-1"></i>{{ $quiz->start_time->format('M d, Y H:i') }}</div>
                                                    <div><i class="fas fa-stop me-1"></i>{{ $quiz->end_time->format('M d, Y H:i') }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="duration-badge">
                                                    {{ $quiz->duration }} min
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons-cell">
                                                    <a href="{{ route('admin.quizzes.show', $quiz->id) }}" class="action-btn view" title="View Quiz">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="action-btn edit" title="Edit Quiz">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="action-btn delete delete-quiz-btn" title="Delete Quiz" data-quiz-title="{{ $quiz->title }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize Enhanced DataTable
    $('#quizzesTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 10,
        "order": [[2, "desc"]], // Sort by schedule column (latest first)
        "language": {
            "search": "Search Quizzes:",
            "emptyTable": "No quizzes available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ quizzes",
            "infoEmpty": "Showing 0 to 0 of 0 quizzes",
            "infoFiltered": "(filtered from _MAX_ total quizzes)",
            "lengthMenu": "Show _MENU_ quizzes",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "zeroRecords": "No matching quizzes found"
        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-5"i><"col-sm-7"p>>',
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                className: 'btn btn-success btn-sm'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> Export PDF',
                className: 'btn btn-danger btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-info btn-sm'
            }
        ]
    });

    // Enhanced Delete Confirmation with SweetAlert2
    $('.delete-quiz-btn').on('click', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const quizTitle = $(this).data('quiz-title');
        
        Swal.fire({
            title: 'Delete Quiz?',
            html: `Are you sure you want to delete the quiz:<br><strong>"${quizTitle}"</strong>?<br><br>This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Yes, Delete Quiz',
            cancelButtonText: '<i class="fas fa-times"></i> Cancel',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Deleting Quiz...',
                    text: 'Please wait while we delete the quiz.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit the form
                form.submit();
            }
        });
    });

    // Animate statistics on page load
    $('.stat-number').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());
        
        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });

    // Enhanced tooltips for action buttons
    $('[title]').tooltip({
        placement: 'top',
        trigger: 'hover'
    });

    // Add status indicators based on quiz timing
    $('tbody tr').each(function() {
        const $row = $(this);
        const startTimeText = $row.find('td:nth-child(3) div:first').text().replace(/.*(\w{3} \d{2}, \d{4} \d{2}:\d{2})/, '$1');
        const endTimeText = $row.find('td:nth-child(3) div:last').text().replace(/.*(\w{3} \d{2}, \d{4} \d{2}:\d{2})/, '$1');
        
        const startTime = new Date(startTimeText);
        const endTime = new Date(endTimeText);
        const now = new Date();
        
        let statusBadge = '';
        if (now < startTime) {
            statusBadge = '<span class="badge badge-warning ms-2"><i class="fas fa-clock"></i> Upcoming</span>';
        } else if (now >= startTime && now <= endTime) {
            statusBadge = '<span class="badge badge-success ms-2"><i class="fas fa-play"></i> Active</span>';
        } else {
            statusBadge = '<span class="badge badge-secondary ms-2"><i class="fas fa-check"></i> Completed</span>';
        }
        
        $row.find('.quiz-title').append(statusBadge);
    });

    // Success message handling
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Great!',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    @endif

    // Error message handling
    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session("error") }}',
            icon: 'error',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'OK',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    @endif
});
</script>

@endsection
