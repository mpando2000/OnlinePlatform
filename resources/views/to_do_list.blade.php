@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="fas fa-tasks me-2"></i>
                        Task Manager
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#" onclick="history.back()">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">To-Do List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Task Statistics -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fas fa-tasks"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Tasks</span>
                        <span class="info-box-number">{{ $tasks->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Completed</span>
                        <span class="info-box-number">{{ $tasks->where('completed', true)->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="info-box bg-warning">
                    <span class="info-box-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{ $tasks->where('completed', false)->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="info-box bg-danger">
                    <span class="info-box-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Overdue</span>
                        <span class="info-box-number">{{ $tasks->where('due_date', '<', now())->where('completed', false)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Add New Task Card -->
            <div class="col-12 mb-4">
                <div class="card add-task-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Add New Task
                        </h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('to-do-list.store') }}" id="add-task-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="task" class="form-label">
                                        <i class="fas fa-edit me-1"></i>
                                        Task Description <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="task" 
                                           id="task"
                                           class="form-control" 
                                           placeholder="Enter your task description"
                                           required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="due_date" class="form-label">
                                        <i class="fas fa-calendar me-1"></i>
                                        Due Date
                                    </label>
                                    <input type="date" 
                                           name="due_date" 
                                           id="due_date"
                                           class="form-control"
                                           min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus"></i> Add Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Task List -->
            <div class="col-12">
                <div class="card task-list-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            My Tasks
                        </h4>
                        <div class="card-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary filter-btn active" data-filter="all">
                                    All
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning filter-btn" data-filter="pending">
                                    Pending
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success filter-btn" data-filter="completed">
                                    Completed
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger filter-btn" data-filter="overdue">
                                    Overdue
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($tasks->isEmpty())
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon mb-3">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <h5>No tasks yet</h5>
                                <p class="text-muted">Start by adding your first task above!</p>
                            </div>
                        @else
                            <div class="task-list">
                                @foreach ($tasks as $task)
                                    @php
                                        $isOverdue = $task->due_date && $task->due_date->isPast() && !$task->completed;
                                        $isCompleted = $task->completed;
                                        $isPending = !$task->completed && !$isOverdue;
                                    @endphp
                                    <div class="task-item {{ $isCompleted ? 'completed' : '' }} {{ $isOverdue ? 'overdue' : '' }}" 
                                         data-task-type="{{ $isCompleted ? 'completed' : ($isOverdue ? 'overdue' : 'pending') }}">
                                        <div class="task-content">
                                            <div class="task-checkbox">
                                                <form method="POST" action="{{ route('to-do-list.update', $task->id) }}" class="task-toggle-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" 
                                                               class="custom-control-input task-checkbox-input" 
                                                               id="task{{ $task->id }}" 
                                                               {{ $task->completed ? 'checked' : '' }}
                                                               onchange="this.form.submit()">
                                                        <label class="custom-control-label" for="task{{ $task->id }}"></label>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="task-details">
                                                <div class="task-text {{ $task->completed ? 'task-completed' : '' }}">
                                                    {{ $task->task }}
                                                </div>
                                                <div class="task-meta">
                                                    @if($task->due_date)
                                                        <span class="task-due-date {{ $isOverdue ? 'overdue' : '' }}">
                                                            <i class="fas fa-calendar-alt"></i>
                                                            Due: {{ $task->due_date->format('M j, Y') }}
                                                            ({{ $task->due_date->diffForHumans() }})
                                                        </span>
                                                    @else
                                                        <span class="task-due-date no-date">
                                                            <i class="fas fa-calendar-times"></i>
                                                            No due date
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="task-actions">
                                                @if($task->completed)
                                                    <span class="task-status completed">
                                                        <i class="fas fa-check-circle"></i>
                                                        Completed
                                                    </span>
                                                @elseif($isOverdue)
                                                    <span class="task-status overdue">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Overdue
                                                    </span>
                                                @else
                                                    <span class="task-status pending">
                                                        <i class="fas fa-hourglass-half"></i>
                                                        Pending
                                                    </span>
                                                @endif
                                                
                                                <form method="POST" action="{{ route('to-do-list.destroy', $task->id) }}" class="task-delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger delete-task-btn"
                                                            data-task-name="{{ $task->task }}"
                                                            title="Delete task">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
        {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<style>
    .content-wrapper {
        padding: 20px;
    }
    
    .page-header {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 25px;
        border-left: 4px solid #007bff;
    }

    .page-title {
        color: #495057;
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    /* Info Boxes */
    .info-box {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .info-box-icon {
        border-radius: 8px 0 0 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-box-content {
        padding: 15px 10px;
    }

    /* Add Task Card */
    .add-task-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .add-task-card .card-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border-radius: 8px 8px 0 0;
        border: none;
    }

    /* Task List Card */
    .task-list-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .task-list-card .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        border-radius: 8px 8px 0 0;
    }

    /* Filter Buttons */
    .filter-btn {
        border-radius: 20px;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: #007bff !important;
        color: white !important;
        border-color: #007bff !important;
    }

    /* Form Elements */
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 6px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 10px 12px;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Task Items */
    .task-list {
        max-height: 600px;
        overflow-y: auto;
    }

    .task-item {
        border-bottom: 1px solid #e9ecef;
        padding: 15px 20px;
        transition: all 0.3s ease;
        background: white;
    }

    .task-item:hover {
        background: #f8f9fa;
    }

    .task-item.completed {
        background: #f8f9fa;
        opacity: 0.8;
    }

    .task-item.overdue {
        border-left: 4px solid #dc3545;
        background: #fff5f5;
    }

    .task-content {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .task-checkbox {
        flex-shrink: 0;
        padding-top: 3px;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #28a745;
        border-color: #28a745;
    }

    .task-details {
        flex-grow: 1;
        min-width: 0;
    }

    .task-text {
        font-size: 1rem;
        font-weight: 500;
        color: #495057;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .task-text.task-completed {
        text-decoration: line-through;
        color: #6c757d;
    }

    .task-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 0.85rem;
    }

    .task-due-date {
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .task-due-date.overdue {
        color: #dc3545;
        font-weight: 500;
    }

    .task-due-date.no-date {
        color: #adb5bd;
    }

    .task-actions {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .task-status {
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 500;
    }

    .task-status.completed {
        background: #d4edda;
        color: #155724;
    }

    .task-status.pending {
        background: #fff3cd;
        color: #856404;
    }

    .task-status.overdue {
        background: #f8d7da;
        color: #721c24;
    }

    .delete-task-btn {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: all 0.3s ease;
    }

    .delete-task-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    }

    /* Empty State */
    .empty-state {
        padding: 40px 20px;
    }

    .empty-icon {
        font-size: 4rem;
        color: #dee2e6;
    }

    .empty-state h5 {
        color: #6c757d;
        margin-bottom: 10px;
    }

    /* Buttons */
    .btn {
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.15s ease-in-out;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Task Filtering */
    .task-item.hidden {
        display: none !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .task-content {
            flex-direction: column;
            gap: 10px;
        }
        
        .task-actions {
            justify-content: space-between;
            width: 100%;
        }

        .info-box {
            margin-bottom: 15px;
        }

        .card-tools .btn-group {
            flex-wrap: wrap;
        }

        .filter-btn {
            margin: 2px;
            font-size: 0.8rem;
            padding: 4px 8px;
        }
    }

    @media (max-width: 576px) {
        .task-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .row .col-md-2 {
            margin-top: 10px;
        }
    }

    /* Loading animation */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Smooth transitions */
    .task-item, .filter-btn, .btn, .form-control {
        transition: all 0.3s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update footer year
        document.getElementById("currentYear").textContent = new Date().getFullYear();

        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const taskItems = document.querySelectorAll('.task-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filter tasks
                taskItems.forEach(task => {
                    const taskType = task.getAttribute('data-task-type');
                    
                    if (filter === 'all') {
                        task.classList.remove('hidden');
                    } else if (filter === taskType) {
                        task.classList.remove('hidden');
                    } else {
                        task.classList.add('hidden');
                    }
                });
                
                // Show/hide empty state
                updateEmptyState();
            });
        });

        // Delete confirmation
        const deleteButtons = document.querySelectorAll('.delete-task-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const taskName = this.getAttribute('data-task-name');
                const form = this.closest('form');
                
                if (confirm(`Are you sure you want to delete the task "${taskName}"?`)) {
                    // Add loading state
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    this.disabled = true;
                    
                    form.submit();
                }
            });
        });

        // Form submission feedback
        const addTaskForm = document.getElementById('add-task-form');
        if (addTaskForm) {
            addTaskForm.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalContent = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                submitBtn.disabled = true;
                
                // Reset button after 5 seconds if form doesn't submit successfully
                setTimeout(() => {
                    submitBtn.innerHTML = originalContent;
                    submitBtn.disabled = false;
                }, 5000);
            });
        }

        // Task completion feedback
        const checkboxForms = document.querySelectorAll('.task-toggle-form');
        checkboxForms.forEach(form => {
            const checkbox = form.querySelector('input[type="checkbox"]');
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.task-item');
                taskItem.classList.add('loading');
                
                // Submit form after a brief delay for better UX
                setTimeout(() => {
                    form.submit();
                }, 300);
            });
        });

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.classList.contains('alert-success')) {
                    alert.style.transition = 'opacity 0.3s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }
            }, 5000);
        });

        // Initialize empty state
        updateEmptyState();

        // Helper function to update empty state
        function updateEmptyState() {
            const visibleTasks = document.querySelectorAll('.task-item:not(.hidden)');
            const emptyState = document.querySelector('.empty-state');
            const taskList = document.querySelector('.task-list');
            
            if (taskList) {
                if (visibleTasks.length === 0) {
                    if (!emptyState) {
                        const emptyStateHtml = `
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon mb-3">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <h5>No tasks found</h5>
                                <p class="text-muted">Try changing the filter or add a new task.</p>
                            </div>
                        `;
                        taskList.insertAdjacentHTML('afterend', emptyStateHtml);
                    }
                } else {
                    const currentEmptyState = document.querySelector('.empty-state');
                    if (currentEmptyState) {
                        currentEmptyState.remove();
                    }
                }
            }
        }

        // Smooth scroll to top when adding tasks
        const addTaskCard = document.querySelector('.add-task-card');
        if (addTaskCard && window.location.hash === '#add-task') {
            addTaskCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Focus on task input when page loads
        const taskInput = document.getElementById('task');
        if (taskInput && window.innerWidth > 768) {
            setTimeout(() => {
                taskInput.focus();
            }, 500);
        }
    });
</script>

@endsection