{{-- @extends('components.dashmaster')
@section('body')

  <div class="content-wrapper custom-dashboard">
    <div class="form-container">
<h3>Assign Class and Subject to {{ $teacher->name }}</h3>

<form method="POST" action="{{ route('adminUsers.store-class-subject-assign', $teacher->id) }}">
    @csrf

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

    <button type="submit" class="btn btn-primary">Assign Class and Subject</button>
</form>
  </div>
  </div>


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

    </script>
@endsection --}}

@extends('components.dashmaster')
@section('body')

<style>
.assign-container {
    background: #f8f9fa;
    min-height: calc(100vh - 60px);
    padding: 20px 0;
}

.assign-header {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    padding: 30px 0;
    margin-bottom: 30px;
    border-radius: 10px;
    position: relative;
}

.assign-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" fill-opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
    background-size: cover;
}

.assign-header h2 {
    margin: 0;
    font-size: 2rem;
    font-weight: 300;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    position: relative;
    z-index: 1;
}

.teacher-info {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-left: 5px solid #4CAF50;
}

.section-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.section-body {
    padding: 25px;
}

.assignment-card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    position: relative;
}

.assignment-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #4CAF50;
}

.assignment-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.assignment-details {
    flex: 1;
}

.assignment-meta {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #6c757d;
    font-size: 0.9rem;
}

.assignment-actions {
    display: flex;
    gap: 10px;
}

.form-section {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
}

.form-pair {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    position: relative;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.form-pair.new-assignment {
    border: 2px dashed #4CAF50;
    background: #f8fff8;
}

.form-group {
    margin-bottom: 20px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.remove-pair-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #dc3545;
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.remove-pair-btn:hover {
    background: #c82333;
    transform: scale(1.1);
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 12px;
    display: block;
    font-size: 0.95rem;
    line-height: 1.5;
}

.form-label i {
    margin-right: 8px;
    width: 16px;
    text-align: center;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 1rem;
    width: 100%;
    background: white;
    color: #495057;
    line-height: 1.5;
    min-height: 45px;
}

.form-control option {
    padding: 8px 12px;
    color: #495057;
    background: white;
}

.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    outline: none;
}

.btn-enhanced {
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-add {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.btn-add:hover {
    background: linear-gradient(135deg, #20c997, #17a2b8);
    transform: translateY(-2px);
    color: white;
}

.btn-assign {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.btn-assign:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
    color: white;
}

.btn-remove {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    padding: 8px 15px;
    font-size: 0.9rem;
}

.btn-remove:hover {
    background: linear-gradient(135deg, #c82333, #a71d2a);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 50px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.stats-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.stat-card {
    flex: 1;
    background: white;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    border-left: 4px solid #4CAF50;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #4CAF50;
    display: block;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    margin-top: 5px;
}

.badge-subject {
    background: #17a2b8;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-class {
    background: #ffc107;
    color: #212529;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Select dropdown styling */
.form-control select,
.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    outline: none;
}

.form-control:hover {
    border-color: #4CAF50;
}

/* Improve readability */
.form-control option {
    padding: 10px 15px;
    font-size: 1rem;
    line-height: 1.4;
}

.form-control optgroup {
    font-weight: 600;
    color: #6c757d;
}

@media (max-width: 768px) {
    .assignment-info {
        flex-direction: column;
        gap: 15px;
    }
    
    .assignment-actions {
        width: 100%;
        justify-content: center;
    }
    
    .stats-row {
        flex-direction: column;
    }
    
    .form-pair {
        padding: 20px 15px;
    }
    
    .form-control {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-spinner {
    color: white;
    font-size: 2rem;
}
</style>

<div class="content-wrapper">
    <div class="assign-container">
        <div class="container">
            <!-- Header -->
            <div class="assign-header text-center">
                <h2>
                    <i class="fas fa-user-graduate" style="margin-right: 10px;"></i>
                    Manage Subject Assignments
                </h2>
                <p style="margin: 10px 0 0 0; opacity: 0.9;">
                    Assign classes and subjects to {{ $teacher->firstname }} {{ $teacher->lastname }}
                </p>
            </div>

            <!-- Teacher Info Card -->
            <div class="teacher-info">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <img src="{{ $teacher->profile_image ? asset('uploads/profile_images/' . $teacher->profile_image) : asset('dist/img/avatar5.png') }}"
                             class="img-fluid rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="Teacher">
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-1">{{ $teacher->firstname }} {{ $teacher->secondname }} {{ $teacher->lastname }}</h4>
                        <p class="text-muted mb-1">
                            <i class="fas fa-envelope me-2"></i>{{ $teacher->email }}
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-user-tag me-2"></i>{{ ucfirst($teacher->role) }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-row">
                            <div class="stat-card">
                                <span class="stat-number" id="totalAssignments">{{ $teacher->teacherSubjects->count() }}</span>
                                <span class="stat-label">Total Assignments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Current Assignments Section -->
                <div class="col-lg-7">
                    <div class="section-card">
                        <div class="section-header">
                            <h4 class="mb-0">
                                <i class="fas fa-list-alt me-2"></i>
                                Current Assignments
                            </h4>
                            <span class="badge badge-light" id="assignmentCount">{{ $teacher->teacherSubjects->count() }} Assignments</span>
                        </div>
                        <div class="section-body">
                            <div id="currentAssignments">
                                @if($teacher->teacherSubjects->count() > 0)
                                    @php
                                        $groupedAssignments = $teacher->teacherSubjects->groupBy('pivot.class_id');
                                    @endphp
                                    @foreach($groupedAssignments as $classId => $subjects)
                                        @php
                                            $class = \App\Models\SchoolClass::find($classId);
                                        @endphp
                                        @if($class && $subjects->isNotEmpty())
                                            <div class="assignment-card">
                                                <div class="assignment-info">
                                                    <div class="assignment-details">
                                                        <h5 class="mb-2">
                                                            <i class="fas fa-school text-warning me-2"></i>
                                                            {{ $class->name }}
                                                        </h5>
                                                        <div class="assignment-meta">
                                                            <div class="meta-item">
                                                                <i class="fas fa-book"></i>
                                                                <span>{{ $subjects->count() }} Subject{{ $subjects->count() !== 1 ? 's' : '' }}</span>
                                                            </div>
                                                            <div class="meta-item">
                                                                <i class="fas fa-calendar-alt"></i>
                                                                @php
                                                                    $firstSubject = $subjects->first();
                                                                    $assignedDate = null;
                                                                    
                                                                    if ($firstSubject && $firstSubject->pivot && $firstSubject->pivot->created_at) {
                                                                        $assignedDate = $firstSubject->pivot->created_at;
                                                                    }
                                                                @endphp
                                                                <span>Assigned {{ $assignedDate ? $assignedDate->diffForHumans() : 'Recently' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            @foreach($subjects as $subject)
                                                                <span class="badge-subject me-2">{{ $subject->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="assignment-actions">
                                                        <button class="btn btn-enhanced btn-remove" onclick="removeAssignment({{ $teacher->id }}, {{ $class->id }})">
                                                            <i class="fas fa-trash"></i>
                                                            Remove Class
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h5>No Assignments Yet</h5>
                                        <p>This teacher has not been assigned to any classes or subjects yet.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add New Assignment Section -->
                <div class="col-lg-5">
                    <div class="section-card">
                        <div class="section-header">
                            <h4 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>
                                Add New Assignment
                            </h4>
                        </div>
                        <div class="section-body">
                            <form method="POST" action="{{ route('adminUsers.store-class-subject-assign', $teacher->id) }}" id="assignmentForm">
                                @csrf
                                
                                <div class="form-section">
                                    <div id="class-subject-container">
                                        <div class="form-pair new-assignment">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="fas fa-school text-warning"></i>
                                                    Select Class
                                                </label>
                                                <select name="classes[]" class="form-control class-select" required>
                                                    <option value="">Choose a class...</option>
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('classes.*')
                                                    <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="fas fa-book text-info"></i>
                                                    Select Subject
                                                </label>
                                                <select name="subjects[]" class="form-control subject-select" required>
                                                    <option value="">First select a class...</option>
                                                </select>
                                                @error('subjects.*')
                                                    <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="button" class="btn-enhanced btn-add add-class-subject">
                                            <i class="fas fa-plus"></i>
                                            Add Another Assignment
                                        </button>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn-enhanced btn-assign">
                                        <i class="fas fa-check"></i>
                                        Assign to Teacher
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Processing assignment...</p>
    </div>
</div>
<!-- Footer -->
<footer class="main-footer" style="margin-top: auto;">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<script>
    let pairCounter = 1;

    // Fetch subjects when class is selected
    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('class-select')) {
            const classId = event.target.value;
            const formPair = event.target.closest('.form-pair');
            const subjectSelect = formPair.querySelector('.subject-select');

            if (classId) {
                showLoading();
                // Fetch subjects based on the selected class
                fetch(`/admin/get-subjects/${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">Select a subject...</option>';
                        data.forEach(subject => {
                            const option = document.createElement('option');
                            option.value = subject.id;
                            option.textContent = subject.name;
                            subjectSelect.appendChild(option);
                        });
                        hideLoading();
                    })
                    .catch(error => {
                        console.error('Error fetching subjects:', error);
                        showNotification('Error fetching subjects. Please try again.', 'error');
                        hideLoading();
                    });
            } else {
                subjectSelect.innerHTML = '<option value="">First select a class...</option>';
            }
        }
    });

    // Add another class-subject pair
    document.querySelector('.add-class-subject').addEventListener('click', function() {
        pairCounter++;
        const container = document.getElementById('class-subject-container');
        const firstPair = container.querySelector('.form-pair');
        const newPair = firstPair.cloneNode(true);
        
        // Clear selections
        newPair.querySelector('.class-select').value = '';
        newPair.querySelector('.subject-select').innerHTML = '<option value="">First select a class...</option>';
        
        // Add remove button if it's not the first pair
        if (pairCounter > 1) {
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-pair-btn';
            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
            removeBtn.onclick = function() { removePair(this); };
            newPair.appendChild(removeBtn);
            newPair.classList.remove('new-assignment');
        }
        
        container.appendChild(newPair);
        
        // Scroll to new pair
        newPair.scrollIntoView({ behavior: 'smooth', block: 'center' });
        showNotification('New assignment pair added', 'success');
    });

    // Remove assignment pair
    function removePair(button) {
        const pair = button.closest('.form-pair');
        pair.style.opacity = '0';
        pair.style.transform = 'scale(0.9)';
        setTimeout(() => {
            pair.remove();
            pairCounter--;
            showNotification('Assignment pair removed', 'info');
        }, 300);
    }

    // Remove assignment from teacher
    function removeAssignment(teacherId, classId) {
        if (confirm('Are you sure you want to remove all assignments for this class? This action cannot be undone.')) {
            showLoading();
            
            // Create form to submit delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/teachers/${teacherId}/remove-class-assignment`;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken.getAttribute('content');
                form.appendChild(csrfInput);
            }
            
            // Add method spoofing for DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Add class ID
            const classInput = document.createElement('input');
            classInput.type = 'hidden';
            classInput.name = 'class_id';
            classInput.value = classId;
            form.appendChild(classInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Form submission handling
    document.getElementById('assignmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate form
        const classSelects = document.querySelectorAll('.class-select');
        const subjectSelects = document.querySelectorAll('.subject-select');
        let isValid = true;
        
        for (let i = 0; i < classSelects.length; i++) {
            if (!classSelects[i].value || !subjectSelects[i].value) {
                showNotification('Please select both class and subject for all assignment pairs', 'error');
                isValid = false;
                break;
            }
        }
        
        if (isValid) {
            showLoading();
            // Show success message and submit
            setTimeout(() => {
                this.submit();
            }, 500);
        }
    });

    // Utility functions
    function showLoading() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }

    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        // Create notification
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : type === 'info' ? '#2196F3' : '#ff9800'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                z-index: 10001;
                font-weight: 500;
                max-width: 300px;
                animation: slideIn 0.3s ease;
            ">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}" 
                   style="margin-right: 8px;"></i>
                ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year
        document.getElementById("currentYear").textContent = new Date().getFullYear();
        
        // Add animation classes
        const cards = document.querySelectorAll('.assignment-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .assignment-card {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        
        .form-pair {
            transition: all 0.3s ease;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
