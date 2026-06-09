@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced User Management Styling */
.user-management-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.page-header {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 30px;
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
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
}

.page-title i {
    margin-right: 15px;
    color: #667eea;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
    background: linear-gradient(135deg, var(--card-color, #667eea), var(--card-color-dark, #764ba2));
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.stat-card.students {
    --card-color: #3498db;
    --card-color-dark: #2980b9;
}

.stat-card.teachers {
    --card-color: #2ecc71;
    --card-color-dark: #27ae60;
}

.stat-card.classes {
    --card-color: #9b59b6;
    --card-color-dark: #8e44ad;
}

.stat-card.recent {
    --card-color: #f39c12;
    --card-color-dark: #e67e22;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    background: linear-gradient(135deg, var(--card-color), var(--card-color-dark));
    margin-bottom: 15px;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
}

.stat-label {
    color: #6c757d;
    font-size: 0.95rem;
    margin: 5px 0 0 0;
}

.users-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.section-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px 30px;
    font-size: 1.3rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.section-header i {
    margin-right: 10px;
}

.role-filter {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 20px;
    padding: 8px 15px;
    font-size: 0.9rem;
}

.role-filter option {
    color: #333;
}

.table-container {
    padding: 0;
}

.enhanced-table {
    margin: 0;
    width: 100%;
}

.enhanced-table thead {
    background: #f8f9fa;
}

.enhanced-table thead th {
    border: none;
    color: #495057;
    font-weight: 600;
    padding: 15px 12px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.enhanced-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    border-top: 1px solid #e9ecef;
}

.user-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
    font-size: 1.1rem;
    margin-right: 12px;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-details {
    flex: 1;
}

.user-name {
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 3px 0;
    font-size: 0.95rem;
}

.user-email {
    color: #6c757d;
    font-size: 0.85rem;
    margin: 0;
}

.role-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge.student {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
}

.role-badge.teacher {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
}

.class-info {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 0.85rem;
    color: #495057;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
}

.btn-view {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.btn-view:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.btn-contact {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
}

.btn-contact:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
}

.btn-action i {
    margin-right: 6px;
    font-size: 0.9rem;
}

.current-user-indicator {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
    padding: 4px 8px;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-left: 10px;
}

.school-info {
    color: #6c757d;
    font-size: 0.85rem;
    font-style: italic;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.3;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    margin: 15px;
}

.dataTables_wrapper .dataTables_filter input {
    border-radius: 20px;
    padding: 8px 15px;
    border: 1px solid #ddd;
}

.dataTables_wrapper .dataTables_length select {
    border-radius: 15px;
    padding: 5px 10px;
}

@media (max-width: 768px) {
    .stats-cards {
        grid-template-columns: 1fr;
    }
    
    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .action-buttons {
        justify-content: flex-start;
        width: 100%;
    }
    
    .section-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
}

.filters-section {
    background: white;
    padding: 20px 30px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 15px;
    flex: 1;
    max-width: 400px;
}

.search-input {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 20px;
    font-size: 0.9rem;
}

.filter-buttons {
    display: flex;
    gap: 10px;
}

.filter-btn {
    padding: 8px 16px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 20px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn.active,
.filter-btn:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.table-actions {
    padding: 20px 30px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.export-buttons {
    display: flex;
    gap: 10px;
}

.btn-export {
    padding: 8px 16px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 15px;
    font-size: 0.85rem;
    color: #495057;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-export:hover {
    background: #f8f9fa;
    color: #495057;
    text-decoration: none;
    transform: translateY(-2px);
}
</style>

<div class="content-wrapper user-management-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-users-cog"></i>
                User Management
            </h1>
            <p class="page-subtitle">
                Manage students, teachers, and view detailed user information
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-cards">
            <div class="stat-card students">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3 class="stat-number">{{ $stats['total_students'] }}</h3>
                <p class="stat-label">Total Students</p>
            </div>
            
            <div class="stat-card teachers">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="stat-number">{{ $stats['total_teachers'] }}</h3>
                <p class="stat-label">Total Teachers</p>
            </div>
            
            <div class="stat-card classes">
                <div class="stat-icon">
                    <i class="fas fa-door-open"></i>
                </div>
                <h3 class="stat-number">{{ $stats['classes_count'] }}</h3>
                <p class="stat-label">Active Classes</p>
            </div>
            
            <div class="stat-card recent">
                <div class="stat-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="stat-number">{{ $stats['recent_registrations'] }}</h3>
                <p class="stat-label">Recent Registrations</p>
            </div>
        </div>

        <!-- Users Section -->
        <div class="users-section">
            <div class="section-header">
                <div>
                    <i class="fas fa-table"></i>
                    All Users (Students & Teachers)
                </div>
                <select class="role-filter" id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="student">Students Only</option>
                    <option value="teacher">Teachers Only</option>
                </select>
            </div>

            <div class="filters-section">
                <div class="search-box">
                    <i class="fas fa-search" style="color: #6c757d;"></i>
                    <input type="text" class="search-input" id="globalSearch" placeholder="Search by name, email, or school...">
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All</button>
                    <button class="filter-btn" data-filter="student">Students</button>
                    <button class="filter-btn" data-filter="teacher">Teachers</button>
                </div>
            </div>

            <div class="table-container">
                @if($users->count() > 0)
                    <table class="enhanced-table table" id="usersTable">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>School</th>
                                <th>Class/Subject</th>
                                <th>Registration Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr data-role="{{ $user->role }}">
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar" style="background: linear-gradient(135deg, {{ $user->role === 'student' ? '#3498db, #2980b9' : '#2ecc71, #27ae60' }})">
                                                {{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
                                            </div>
                                            <div class="user-details">
                                                <h6 class="user-name">
                                                    {{ $user->firstname }} {{ $user->lastname }}
                                                    @if($user->id === $currentUser->id)
                                                        <span class="current-user-indicator">You</span>
                                                    @endif
                                                </h6>
                                                <p class="user-email">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="role-badge {{ $user->role }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="school-info">
                                            @php
                                                $schoolName = 'Not specified';
                                                
                                                // Try to get school from manually loaded school model first
                                                if(isset($user->schoolModel) && $user->schoolModel) {
                                                    $schoolName = $user->schoolModel->name;
                                                } 
                                                // Fallback to old school field (for legacy users)
                                                else {
                                                    $legacySchool = $user->getAttributes()['school'] ?? null;
                                                    if(!empty($legacySchool) && is_string($legacySchool)) {
                                                        $schoolName = ucfirst($legacySchool);
                                                    }
                                                }
                                            @endphp
                                            {{ $schoolName }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role === 'student')
                                            <div class="class-info">
                                                <i class="fas fa-door-open"></i>
                                                {{ optional($user->schoolClass)->name ?? 'No class assigned' }}
                                            </div>
                                        @else
                                            <div class="class-info">
                                                <i class="fas fa-book"></i>
                                                {{ $user->subjects->count() > 0 ? $user->subjects->pluck('name')->implode(', ') : 'No subjects assigned' }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-size: 0.85rem; color: #6c757d;">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $user->created_at->format('M d, Y') }}
                                            <br>
                                            <small style="color: #adb5bd;">{{ $user->created_at->diffForHumans() }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/teacher/viewUser/{{ $user->id }}" class="btn-action btn-view">
                                                <i class="fas fa-eye"></i>
                                                View Profile
                                            </a>
                                            @if($user->role === 'student' || $user->role === 'teacher')
                                                <a href="mailto:{{ $user->email }}" class="btn-action btn-contact">
                                                    <i class="fas fa-envelope"></i>
                                                    Contact
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <h4>No Users Found</h4>
                        <p>There are no users to display at this time.</p>
                    </div>
                @endif
            </div>

            @if($users->count() > 0)
                <div class="table-actions">
                    <div>
                        <small class="text-muted">
                            Showing {{ $users->count() }} users ({{ $students->count() }} students, {{ $teachers->count() }} teachers)
                        </small>
                    </div>
                    <div class="export-buttons">
                        <a href="#" class="btn-export" onclick="exportTableToCSV('usersTable', 'users-report')">
                            <i class="fas fa-file-csv"></i> Export CSV
                        </a>
                        <a href="#" class="btn-export" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </a>
                    </div>
                </div>
            @endif
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable with enhanced features
    const table = $('#usersTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 25,
        "order": [[1, "asc"], [0, "asc"]], // Sort by role, then by name
        "columnDefs": [
            { "orderable": false, "targets": 5 }, // Disable sorting for actions column
            { "width": "25%", "targets": 0 }, // User column width
            { "width": "10%", "targets": 1 }, // Role column width
            { "width": "15%", "targets": 2 }, // School column width
            { "width": "20%", "targets": 3 }, // Class/Subject column width
            { "width": "15%", "targets": 4 }, // Date column width
            { "width": "15%", "targets": 5 }  // Actions column width
        ],
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search users...",
            "lengthMenu": "Show _MENU_ users per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ users",
            "infoEmpty": "No users found",
            "infoFiltered": "(filtered from _MAX_ total users)",
            "emptyTable": "No users available",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "dom": '<"top"lf>rt<"bottom"ip><"clear">',
        "initComplete": function() {
            // Hide default search since we have custom search
            $('.dataTables_filter').hide();
            
            // Show success message after initialization
            console.log('✅ Enhanced User Management loaded successfully!');
        }
    });

    // Custom search functionality
    const globalSearch = document.getElementById('globalSearch');
    if (globalSearch) {
        globalSearch.addEventListener('keyup', function() {
            table.search(this.value).draw();
        });
    }

    // Role filter functionality
    const roleFilter = document.getElementById('roleFilter');
    if (roleFilter) {
        roleFilter.addEventListener('change', function() {
            if (this.value === '') {
                table.column(1).search('').draw();
            } else {
                table.column(1).search(this.value).draw();
            }
            
            // Update active filter button
            const filterBtns = document.querySelectorAll('.filter-btn');
            filterBtns.forEach(btn => btn.classList.remove('active'));
            
            const activeBtn = document.querySelector(`.filter-btn[data-filter="${this.value || 'all'}"]`);
            if (activeBtn) activeBtn.classList.add('active');
        });
    }

    // Filter buttons functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Apply filter
            if (filter === 'all') {
                table.column(1).search('').draw();
                roleFilter.value = '';
            } else {
                table.column(1).search(filter).draw();
                roleFilter.value = filter;
            }
        });
    });

    // Export to CSV function
    window.exportTableToCSV = function(tableId, filename) {
        const csv = [];
        const table = document.getElementById(tableId);
        const rows = table.querySelectorAll('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = [];
            const cols = rows[i].querySelectorAll('td, th');
            
            for (let j = 0; j < cols.length - 1; j++) { // Exclude actions column
                let cellText = cols[j].textContent.trim();
                cellText = cellText.replace(/\s+/g, ' '); // Clean up whitespace
                row.push('"' + cellText + '"');
            }
            csv.push(row.join(','));
        }

        // Download CSV
        const csvString = csv.join('\n');
        const blob = new Blob([csvString], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = filename + '.csv';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);

        // Show success notification
        Swal.fire({
            icon: 'success',
            title: 'Export Successful!',
            text: 'Users data has been exported to CSV file.',
            timer: 2000,
            showConfirmButton: false
        });
    };

    // Enhanced tooltip functionality
    const tooltips = document.querySelectorAll('[title]');
    tooltips.forEach(tooltip => {
        tooltip.addEventListener('mouseenter', function() {
            this.setAttribute('data-original-title', this.getAttribute('title'));
            this.removeAttribute('title');
        });
    });

    // Animate statistics cards on page load
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Enhanced search with debouncing
    let searchTimeout;
    if (globalSearch) {
        globalSearch.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                table.search(this.value).draw();
            }, 300);
        });
    }

    // Print functionality enhancement
    window.addEventListener('beforeprint', function() {
        // Hide action buttons and enhance print layout
        const actionBtns = document.querySelectorAll('.action-buttons');
        actionBtns.forEach(btn => btn.style.display = 'none');
        
        // Add print-specific styles
        const printStyle = document.createElement('style');
        printStyle.innerHTML = `
            @media print {
                .content-wrapper { background: white !important; }
                .stats-cards { display: none !important; }
                .filters-section { display: none !important; }
                .table-actions { display: none !important; }
                .section-header { background: white !important; color: black !important; }
            }
        `;
        document.head.appendChild(printStyle);
    });

    window.addEventListener('afterprint', function() {
        // Restore action buttons
        const actionBtns = document.querySelectorAll('.action-buttons');
        actionBtns.forEach(btn => btn.style.display = 'flex');
        
        // Remove print styles
        const printStyles = document.querySelectorAll('style');
        printStyles.forEach(style => {
            if (style.innerHTML.includes('@media print')) {
                style.remove();
            }
        });
    });

    // Footer year update
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    
</script>
@endsection

