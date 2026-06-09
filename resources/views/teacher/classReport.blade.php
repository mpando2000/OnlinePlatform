@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Teacher Class Report Page Styling */
.class-report-container {
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



.class-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(32, 201, 151, 0.05) 100%);
    border-radius: 15px;
}

.class-stat-item {
    text-align: center;
    padding: 15px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.class-stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.class-stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 5px;
}

.class-stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
    font-size: 0.95rem;
}

.enhanced-table tbody tr {
    transition: all 0.3s ease;
}

.enhanced-table tbody tr:hover {
    background-color: #f8f9ff;
    transform: scale(1.01);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.class-name-cell {
    display: flex;
    align-items: center;
    gap: 15px;
}

.class-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(45deg, #28a745, #20c997);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.class-info {
    flex: 1;
}

.class-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 3px;
}

.class-meta {
    font-size: 0.85rem;
    color: #6c757d;
}

.class-actions {
    display: flex;
    gap: 8px;
}

.action-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.action-icon.view {
    background: linear-gradient(45deg, #28a745, #20c997);
    box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
}

.action-icon:hover {
    transform: translateY(-2px) scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Animation Classes */
.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-slideInLeft {
    animation: slideInLeft 0.8s ease-out forwards;
}

.animate-zoomIn {
    animation: zoomIn 0.6s ease-out forwards;
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

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
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
    
    .class-stats-grid {
        grid-template-columns: 1fr;
    }
    
    .class-name-cell {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<div class="content-wrapper">
    <div class="class-report-container">
        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Class Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teacher.report') }}">Reports</a></li>
                            <li class="breadcrumb-item active">Class Reports</li>
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
                                <a href="{{route('teacher.classPrint')}}" class="action-btn print-btn">
                                    <i class="fas fa-print"></i>
                                    Print Report
                                </a>
                                <div class="report-stats">
                                    <i class="fas fa-chart-bar"></i>
                                    Total Classes: {{ count($classes) }}
                                </div>
                            </div>

                            <!-- Class Statistics -->
                            <div class="class-stats-grid animate-zoomIn">
                                <div class="class-stat-item">
                                    <div class="class-stat-number">{{ count($classes) }}</div>
                                    <div class="class-stat-label">Available Classes</div>
                                </div>
                                <div class="class-stat-item">
                                    <div class="class-stat-number">{{ App\Models\Subject::count() }}</div>
                                    <div class="class-stat-label">Total Subjects</div>
                                </div>
                                <div class="class-stat-item">
                                    <div class="class-stat-number">{{ App\Models\User::where('role', 'student')->count() }}</div>
                                    <div class="class-stat-label">Total Students</div>
                                </div>
                                <div class="class-stat-item">
                                    <div class="class-stat-number">{{ date('Y') }}</div>
                                    <div class="class-stat-label">Academic Year</div>
                                </div>
                            </div>

                            <!-- Enhanced Table -->
                            <div class="table-responsive">
                                <table class="table enhanced-table" id="TABLE_CLASS_REPORT">
                                    <thead>
                                        <tr>
                                            <th style="width: 8%;"><i class="fas fa-hashtag me-2"></i>No</th>
                                            <th style="width: 65%;"><i class="fas fa-chalkboard me-2"></i>Class Information</th>
                                            <th style="width: 20%;"><i class="fas fa-calendar-alt me-2"></i>Created</th>
                                            <th style="width: 7%;"><i class="fas fa-eye me-2"></i>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $class)
                                        <tr>
                                            <td class="text-center">
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>
                                                <div class="class-name-cell">
                                                    <div class="class-icon">
                                                        {{ substr($class->name, 0, 1) }}
                                                    </div>
                                                    <div class="class-info">
                                                        <div class="class-name">{{ $class->name }}</div>
                                                        <div class="class-meta">
                                                            <i class="fas fa-graduation-cap me-1"></i>
                                                            Academic Class
                                                            @if($class->subjects && $class->subjects->count() > 0)
                                                                • {{ $class->subjects->count() }} Subjects
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $class->created_at ? $class->created_at->format('M d, Y') : 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="class-actions">
                                                    <a href="#" class="action-icon view" title="View Class Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
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
    $('#TABLE_CLASS_REPORT').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "language": {
            "search": "🔍 Search classes:",
            "lengthMenu": "Show _MENU_ classes per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ classes",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "→",
                "previous": "←"
            },
            "emptyTable": "No classes found in the system",
            "zeroRecords": "No matching classes found"
        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-5"i><"col-sm-7"p>>',
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "orderable": false, "targets": [3] }, // Actions column not sortable
            { "className": "text-center", "targets": [0] }
        ]
    });

    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced hover effects for table rows
    $('.enhanced-table tbody tr').hover(
        function() {
            $(this).css('background-color', '#f8f9ff');
        },
        function() {
            $(this).css('background-color', '');
        }
    );

    // Statistics counter animation
    $('.class-stat-number').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());
        
        if (countTo > 0 && countTo < 1000) { // Only animate reasonable numbers
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 1500,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        }
    });

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

    // View action functionality
    $('.action-icon.view').on('click', function(e) {
        e.preventDefault();
        const className = $(this).closest('tr').find('.class-name').text();
        
        Swal.fire({
            title: 'Class Information',
            html: `
                <div class="text-left">
                    <h5><i class="fas fa-chalkboard me-2"></i>${className}</h5>
                    <p class="text-muted">Class details and student information will be available in future updates.</p>
                    <div class="mt-3">
                        <small class="text-info">
                            <i class="fas fa-info-circle me-1"></i>
                            Enhanced class management features coming soon for teachers!
                        </small>
                    </div>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Got it!',
            confirmButtonColor: '#28a745',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    });

    // Enhanced tooltip for action buttons
    $('[title]').tooltip({
        placement: 'top',
        trigger: 'hover'
    });

    // Class icon color randomization for visual variety
    $('.class-icon').each(function() {
        const colors = [
            'linear-gradient(45deg, #28a745, #20c997)',
            'linear-gradient(45deg, #20c997, #17a2b8)',
            'linear-gradient(45deg, #ffc107, #fd7e14)',
            'linear-gradient(45deg, #17a2b8, #007bff)',
            'linear-gradient(45deg, #155724, #28a745)'
        ];
        const randomColor = colors[Math.floor(Math.random() * colors.length)];
        $(this).css('background', randomColor);
    });

    console.log('✅ Enhanced Teacher Class Report page initialized successfully!');
    console.log(`📊 Total classes loaded: {{ count($classes) }}`);
    console.log('👨‍🏫 Teacher view with appropriate access level');
});
</script>

@endsection
