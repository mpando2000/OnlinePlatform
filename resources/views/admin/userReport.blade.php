@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced User Report Page Styling */
.user-report-container {
    background: #f4f6f9;
    min-height: 100vh;
    padding: 0;
}

.report-content {
    padding: 20px 0;
    position: relative;
}

.report-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: none;
    margin-bottom: 20px;
}

.action-buttons {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 25px 30px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: between;
    align-items: center;
    gap: 15px;
}

.action-btn {
    padding: 12px 25px;
    border-radius: 20px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    font-size: 0.95rem;
}

.action-btn.print-btn {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.action-btn.print-btn:hover {
    background: linear-gradient(45deg, #20c997, #17a2b8);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
}

.report-stats {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 15px 25px;
    border-radius: 15px;
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.enhanced-table {
    margin: 0;
}

.enhanced-table thead th {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 15px 12px;
    border: none;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

.enhanced-table tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
    font-size: 0.9rem;
}

.enhanced-table tbody tr {
    transition: all 0.3s ease;
}

.enhanced-table tbody tr:hover {
    background-color: #f8f9ff;
    transform: scale(1.01);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.role-badge {
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge.admin {
    background: linear-gradient(45deg, #dc3545, #e83e8c);
    color: white;
}

.role-badge.teacher {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.role-badge.student {
    background: linear-gradient(45deg, #007bff, #6610f2);
    color: white;
}

.time-spent {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    color: white;
    padding: 6px 12px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.85rem;
}

/* Animation Classes */
.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-slideInLeft {
    animation: slideInLeft 0.8s ease-out forwards;
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

/* Responsive Design */
@media (max-width: 768px) {
    .action-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .report-stats {
        margin-left: 0;
        margin-top: 10px;
    }
}
</style>

<div class="content-wrapper">
    <div class="user-report-container">
        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.report') }}">Reports</a></li>
                            <li class="breadcrumb-item active">User Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="report-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="report-card animate-slideInLeft">
                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{route('admin.reportPrint')}}" class="action-btn print-btn">
                                    <i class="fas fa-print"></i>
                                    Print Report
                                </a>
                                <div class="report-stats">
                                    <i class="fas fa-chart-bar"></i>
                                    Total Users: {{ count($users) }}
                                </div>
                            </div>

                            <!-- Enhanced Table -->
                            <div class="table-responsive">
                                <table class="table enhanced-table" id="TABLE_USER_2"> 
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-hashtag me-2"></i>No</th>
                                            <th><i class="fas fa-user me-2"></i>First Name</th>
                                            <th><i class="fas fa-user-tag me-2"></i>Second Name</th>
                                            <th><i class="fas fa-user-circle me-2"></i>Last Name</th>
                                            <th><i class="fas fa-envelope me-2"></i>Email</th>
                                            <th><i class="fas fa-user-shield me-2"></i>Role</th>
                                            <th><i class="fas fa-clock me-2"></i>Time Spent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user) 
                                        <tr>
                                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-2">
                                                        <i class="fas fa-user-circle text-primary" style="font-size: 1.5rem;"></i>
                                                    </div>
                                                    {{ $user->firstname }}
                                                </div>
                                            </td>
                                            <td>{{ $user->secondname }}</td>
                                            <td>{{ $user->lastname }}</td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                                    {{ $user->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="role-badge {{ strtolower($user->role) }}">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="time-spent">
                                                    {{ $user->getTimeSpentAttribute() }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
$(document).ready(function() {
    // Initialize DataTable with enhanced features
    $('#TABLE_USER_2').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "language": {
            "search": "🔍 Search users:",
            "lengthMenu": "Show _MENU_ users per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ users",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "→",
                "previous": "←"
            }
        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-5"i><"col-sm-7"p>>',
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "orderable": false, "targets": [6] }, // Time spent column not sortable
            { "className": "text-center", "targets": [0] }
        ]
    });

    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Add hover effects and animations
    $('.enhanced-table tbody tr').hover(
        function() {
            $(this).css('background-color', '#f8f9ff');
        },
        function() {
            $(this).css('background-color', '');
        }
    );

    // Print button enhancement
    $('.print-btn').on('click', function(e) {
        e.preventDefault();
        
        // Show loading state
        const originalText = $(this).html();
        $(this).html('<i class="fas fa-spinner fa-spin"></i> Preparing...');
        
        setTimeout(() => {
            window.location.href = $(this).attr('href');
            $(this).html(originalText);
        }, 1000);
    });

    console.log('✅ User Report page enhanced successfully!');
    console.log(`📊 Total users loaded: {{ count($users) }}`);
});
</script>

@endsection