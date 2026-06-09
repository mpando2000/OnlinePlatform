@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Assignments Management Styling */
.assignments-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.page-header {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 30px;
    animation: fadeInDown 0.6s ease;
}

.page-title {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.page-title i {
    margin-right: 15px;
    color: #27ae60;
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.add-assignment-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
    display: inline-flex;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.add-assignment-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
    color: white;
    text-decoration: none;
}

.add-assignment-btn i {
    margin-right: 8px;
    font-size: 1.1rem;
}

.assignments-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.card-header-custom {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
    color: white;
    padding: 25px 30px;
    border: none;
}

.card-header-custom h3 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.card-header-custom h3 i {
    margin-right: 10px;
    color: #3498db;
}

.stats-container {
    padding: 20px 30px;
    background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
    border-bottom: 1px solid #e0e0e0;
}

.stats-item {
    text-align: center;
    padding: 15px;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: #27ae60;
    display: block;
    margin-bottom: 5px;
}

.stats-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

.table-container {
    padding: 30px;
    overflow-x: auto;
}

.assignments-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.assignments-table thead th {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
    color: white;
    padding: 18px 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
    border: none;
    position: relative;
}

.assignments-table thead th:first-child {
    border-top-left-radius: 12px;
}

.assignments-table thead th:last-child {
    border-top-right-radius: 12px;
}

.assignments-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #ecf0f1;
}

.assignments-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.assignments-table tbody tr:last-child {
    border-bottom: none;
}

.assignments-table tbody td {
    padding: 20px 15px;
    vertical-align: middle;
    border: none;
}

.assignment-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
    margin: 0;
    display: flex;
    align-items: center;
}

.assignment-title i {
    margin-right: 10px;
    color: #3498db;
    font-size: 1.2rem;
}

.action-btn {
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    margin: 0 5px;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
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

.action-btn i {
    margin-right: 5px;
    font-size: 0.9rem;
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

.empty-state h3 {
    color: #2c3e50;
    margin-bottom: 15px;
}

.empty-state p {
    font-size: 1.1rem;
    margin-bottom: 30px;
}

/* Search and Filter Section */
.search-section {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.6s ease;
}

.search-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.search-title i {
    margin-right: 10px;
    color: #27ae60;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .add-assignment-btn {
        display: block;
        text-align: center;
        margin-top: 15px;
    }
    
    .assignments-table {
        font-size: 0.9rem;
    }
    
    .assignments-table thead th,
    .assignments-table tbody td {
        padding: 12px 8px;
    }
    
    .action-btn {
        padding: 6px 12px;
        margin: 2px;
        font-size: 0.8rem;
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

/* Status Badge Styling */
.badge {
    display: inline-flex;
    align-items: center;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.badge i {
    margin-right: 4px;
    font-size: 0.7rem;
}

.badge-success {
    animation: pulse-success 2s infinite;
}

.badge-danger {
    animation: pulse-danger 2s infinite;
}

.badge-warning {
    animation: pulse-warning 2s infinite;
}

@keyframes pulse-success {
    0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
}

@keyframes pulse-danger {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

@keyframes pulse-warning {
    0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
}

/* Enhanced deadline display */
.deadline-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.deadline-date {
    font-weight: 600;
    font-size: 1rem;
}

.deadline-relative {
    font-size: 0.85rem;
    opacity: 0.8;
}

.deadline-status {
    align-self: flex-start;
}

/* Urgent deadline highlighting */
.urgent-deadline {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: white !important;
    animation: urgentBlink 1s infinite alternate;
}

@keyframes urgentBlink {
    0% { opacity: 1; }
    100% { opacity: 0.7; }
}

/* DataTable Custom Styling */
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border-radius: 20px;
    border: 2px solid #e0e0e0;
    padding: 8px 15px;
}

.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #27ae60;
    box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
}

.dt-buttons .btn {
    border-radius: 20px;
    margin-right: 5px;
    padding: 8px 16px;
    font-weight: 500;
}
</style>

<div class="content-wrapper assignments-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-clipboard-list"></i>
                        Assignment Management
                    </h1>
                    <p style="color: #7f8c8d; margin-top: 10px; font-size: 1.1rem;">
                        Manage and organize all your class assignments
                    </p>
                </div>
                <div class="col-md-4 text-right">
                    <a href="/addAssignment" class="add-assignment-btn">
                        <i class="fas fa-plus"></i>
                        Create Assignment
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        @if($assignments->count() > 0)
        <div class="search-section">
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-item">
                        <span class="stats-number">{{ $assignments->count() }}</span>
                        <span class="stats-label">Total Assignments</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-item">
                        <span class="stats-number">{{ $assignments->where('created_at', '>=', now()->startOfWeek())->count() }}</span>
                        <span class="stats-label">This Week</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-item">
                        <span class="stats-number">{{ $assignments->where('created_at', '>=', now()->startOfMonth())->count() }}</span>
                        <span class="stats-label">This Month</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-item">
                        <span class="stats-number">{{ $assignments->where('submission_deadline', '>=', now())->count() }}</span>
                        <span class="stats-label">Active</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <div class="row">
            <div class="col-12">
                <div class="assignments-card">
                    <div class="card-header-custom">
                        <h3>
                            <i class="fas fa-list"></i>
                            All Assignments
                        </h3>
                    </div>

                    <div class="table-container">
                        @if($assignments->count() > 0)
                            <table id="assignmentsTable" class="assignments-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-file-alt"></i> Assignment Title</th>
                                        <th><i class="fas fa-calendar"></i> Created Date</th>
                                        <th><i class="fas fa-clock"></i> Submission Deadline</th>
                                        <th><i class="fas fa-cogs"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignments as $assignment)
                                    <tr>
                                        <td>
                                            <h5 class="assignment-title">
                                                <i class="fas fa-clipboard-check"></i>
                                                {{ $assignment->title }}
                                            </h5>
                                            @if($assignment->description)
                                                <small style="color: #7f8c8d;">
                                                    {{ Str::limit($assignment->description, 50) }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="color: #27ae60; font-weight: 500;">
                                                <i class="fas fa-calendar-plus"></i>
                                                {{ $assignment->created_at->format('M d, Y') }}
                                            </span>
                                            <br>
                                            <small style="color: #7f8c8d;">
                                                {{ $assignment->created_at->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($assignment->submission_deadline)
                                                <span style="color: {{ $assignment->submission_deadline > now() ? '#3498db' : '#e74c3c' }}; font-weight: 500;">
                                                    <i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($assignment->submission_deadline)->format('M d, Y H:i') }}
                                                </span>
                                                <br>
                                                <small style="color: #7f8c8d;">
                                                    {{ \Carbon\Carbon::parse($assignment->submission_deadline)->diffForHumans() }}
                                                </small>
                                                <br>
                                                @if($assignment->submission_deadline > now())
                                                    <span class="badge badge-success" style="background: #28a745; color: white; padding: 3px 8px; border-radius: 12px; font-size: 0.75rem;">
                                                        <i class="fas fa-check-circle"></i> Active
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger" style="background: #dc3545; color: white; padding: 3px 8px; border-radius: 12px; font-size: 0.75rem;">
                                                        <i class="fas fa-times-circle"></i> Overdue
                                                    </span>
                                                @endif
                                            @else
                                                <span style="color: #7f8c8d;">
                                                    <i class="fas fa-minus-circle"></i>
                                                    No deadline set
                                                </span>
                                                <br>
                                                <span class="badge badge-warning" style="background: #ffc107; color: #212529; padding: 3px 8px; border-radius: 12px; font-size: 0.75rem;">
                                                    <i class="fas fa-exclamation-triangle"></i> No Deadline
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('assignment.show', $assignment->id) }}" class="action-btn view-btn">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>
                                            <button type="button" class="action-btn delete-btn" onclick="confirmDelete('{{ $assignment->id }}', '{{ $assignment->title }}')">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                            
                                            <form id="deleteAssignment-form-{{ $assignment->id }}" action="/deleteAssignment/{{ $assignment->id }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <h3>No Assignments Found</h3>
                                <p>You haven't created any assignments yet. Start by creating your first assignment.</p>
                                <a href="/addAssignment" class="add-assignment-btn">
                                    <i class="fas fa-plus"></i>
                                    Create Your First Assignment
                                </a>
                            </div>
                        @endif
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
        <b>Teacher Portal</b> v2.0
    </div>
</footer>

<!-- Enhanced JavaScript -->
<script>
    // Initialize DataTable with custom styling
    $(function () {
        $("#assignmentsTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[2, "asc"]], // Sort by submission deadline asc (soonest first)
            "language": {
                "search": "Search assignments:",
                "lengthMenu": "Show _MENU_ assignments per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ assignments",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "emptyTable": "No assignments found"
            },
            "buttons": [
                {
                    extend: 'copy',
                    className: 'btn btn-primary',
                    text: '<i class="fas fa-copy"></i> Copy'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-success',
                    text: '<i class="fas fa-file-csv"></i> CSV'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fas fa-file-excel"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fas fa-file-pdf"></i> PDF'
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    text: '<i class="fas fa-print"></i> Print'
                }
            ]
        }).buttons().container().appendTo('#assignmentsTable_wrapper .col-md-6:eq(0)');
    });

    // Confirm delete function with SweetAlert-style confirmation
    function confirmDelete(assignmentId, assignmentTitle) {
        const confirmation = confirm(`Are you sure you want to delete the assignment "${assignmentTitle}"?\n\nThis action cannot be undone.`);
        
        if (confirmation) {
            // Show loading state
            const deleteBtn = event.target.closest('.delete-btn');
            const originalText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
            deleteBtn.disabled = true;
            
            // Add a small delay for better UX
            setTimeout(() => {
                document.getElementById(`deleteAssignment-form-${assignmentId}`).submit();
            }, 500);
        }
    }

    // Add hover effects and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year
        document.getElementById("currentYear").textContent = new Date().getFullYear();
        
        // Add animation to cards on load
        const cards = document.querySelectorAll('.assignments-card, .page-header, .search-section');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Add smooth scroll to top functionality
        const addBtn = document.querySelector('.add-assignment-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        }
        
        // Add row hover effects
        const tableRows = document.querySelectorAll('.assignments-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });
        
        // Highlight urgent deadlines (within 24 hours)
        highlightUrgentDeadlines();
        
        // Initialize tooltips if needed
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Add success message handling
    function showSuccessMessage(message) {
        const successDiv = document.createElement('div');
        successDiv.className = 'alert alert-success alert-dismissible fade show';
        successDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.5s ease;
        `;
        successDiv.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <strong>Success!</strong> ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(successDiv);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            successDiv.remove();
        }, 5000);
    }

    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .alert {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 20px !important;
            margin: 0 2px;
            transition: all 0.3s ease;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            transform: translateY(-1px);
        }
        
        .dt-buttons .btn {
            transition: all 0.3s ease;
        }
        
        .dt-buttons .btn:hover {
            transform: translateY(-2px);
        }
    `;
    document.head.appendChild(style);

    // Highlight urgent deadlines
    function highlightUrgentDeadlines() {
        const now = new Date();
        const urgentThreshold = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
        
        document.querySelectorAll('.assignments-table tbody tr').forEach(row => {
            const deadlineCell = row.cells[2]; // Submission deadline column
            const deadlineText = deadlineCell.textContent;
            
            // Extract datetime from the cell if it exists
            const dateMatch = deadlineText.match(/(\w+ \d+, \d+ \d+:\d+)/);
            if (dateMatch) {
                const deadlineDate = new Date(dateMatch[1]);
                const timeDiff = deadlineDate.getTime() - now.getTime();
                
                // If deadline is within 24 hours and still active
                if (timeDiff > 0 && timeDiff <= urgentThreshold) {
                    const badge = deadlineCell.querySelector('.badge-success');
                    if (badge) {
                        badge.classList.add('urgent-deadline');
                        badge.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Urgent';
                    }
                    
                    // Highlight the entire row
                    row.style.background = 'linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%)';
                    row.style.border = '2px solid #f39c12';
                }
            }
        });
    }

    // Update urgent deadline highlighting every minute
    setInterval(highlightUrgentDeadlines, 60000);

    // Check for success messages from Laravel session
    @if(session('success'))
        showSuccessMessage('{{ session('success') }}');
    @endif
</script>
@endsection



