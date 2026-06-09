
@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Quiz Results Styling */
.quiz-results-container {
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
    margin: 0;
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

.quiz-info {
    position: relative;
    z-index: 1;
    margin-top: 15px;
}

.quiz-meta {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
    color: #6c757d;
}

.meta-item {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.meta-item i {
    margin-right: 8px;
    color: #667eea;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
}

.stat-card.average::before { background: linear-gradient(135deg, #3498db, #2980b9); }
.stat-card.highest::before { background: linear-gradient(135deg, #2ecc71, #27ae60); }
.stat-card.lowest::before { background: linear-gradient(135deg, #e74c3c, #c0392b); }
.stat-card.total::before { background: linear-gradient(135deg, #f39c12, #e67e22); }

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: white;
}

.stat-card.average .stat-icon { background: linear-gradient(135deg, #3498db, #2980b9); }
.stat-card.highest .stat-icon { background: linear-gradient(135deg, #2ecc71, #27ae60); }
.stat-card.lowest .stat-icon { background: linear-gradient(135deg, #e74c3c, #c0392b); }
.stat-card.total .stat-icon { background: linear-gradient(135deg, #f39c12, #e67e22); }

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
}

.results-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.results-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px 30px;
    display: flex;
    justify-content: between;
    align-items: center;
}

.results-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.results-title i {
    margin-right: 10px;
}

.action-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-upload {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-upload:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-upload i {
    margin-right: 8px;
}

.results-table-container {
    padding: 0;
}

.enhanced-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.enhanced-table thead th {
    background: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 20px 25px;
    border: none;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.enhanced-table tbody td {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.enhanced-table tbody tr {
    transition: all 0.3s ease;
}

.enhanced-table tbody tr:hover {
    background: #f8f9fa;
    transform: scale(1.01);
}

.student-info {
    display: flex;
    align-items: center;
}

.student-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    margin-right: 15px;
    font-size: 0.9rem;
}

.student-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.score-badge {
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-block;
    min-width: 80px;
    text-align: center;
}

.score-excellent { background: #d4edda; color: #155724; }
.score-good { background: #d1ecf1; color: #0c5460; }
.score-average { background: #fff3cd; color: #856404; }
.score-poor { background: #f8d7da; color: #721c24; }

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #dee2e6;
}

.empty-state h4 {
    margin-bottom: 10px;
    color: #495057;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .results-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .quiz-meta {
        justify-content: center;
    }
}
</style>

<div class="content-wrapper quiz-results-container">
    <!-- Page Header -->
    <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-chart-bar"></i>
                Quiz Results: {{ $quiz->title }}
            </h1>
            
            <div class="quiz-info">
                <div class="quiz-meta">
                    <div class="meta-item">
                        <i class="fas fa-graduation-cap"></i>
                        {{ $quiz->class->name ?? 'N/A' }}
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-book"></i>
                        {{ $quiz->subject->name ?? 'N/A' }}
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        {{ $quiz->duration }} minutes
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        {{ $quiz->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="container-fluid">
        @if(count($quizResults) > 0)
            @php
                $totalStudents = count($quizResults);
                $averageScore = round($quizResults->avg('percentage'), 1);
                $highestScore = $quizResults->max('percentage');
                $lowestScore = $quizResults->min('percentage');
            @endphp
            
            <div class="stats-grid">
                <div class="stat-card total">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value">{{ $totalStudents }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
                
                <div class="stat-card average">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-value">{{ $averageScore }}%</div>
                    <div class="stat-label">Average Score</div>
                </div>
                
                <div class="stat-card highest">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-value">{{ $highestScore }}%</div>
                    <div class="stat-label">Highest Score</div>
                </div>
                
                <div class="stat-card lowest">
                    <div class="stat-icon">
                        <i class="fas fa-chart-area"></i>
                    </div>
                    <div class="stat-value">{{ $lowestScore }}%</div>
                    <div class="stat-label">Lowest Score</div>
                </div>
            </div>
        @endif
    </div>

    <!-- Results Table -->
    <div class="container-fluid">
        <div class="results-card">
            <div class="results-header">
                <h3 class="results-title">
                    <i class="fas fa-list-alt"></i>
                    Student Results
                </h3>
                <div class="action-buttons">
                    <a href="{{ route('quizzes.uploadResultsForm', $quiz->id) }}" class="btn-upload">
                        <i class="fas fa-upload"></i>
                        Upload Results
                    </a>
                    <button onclick="exportResults()" class="btn-upload">
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                </div>
            </div>
            
            <div class="results-table-container">
                @if(count($quizResults) > 0)
                    <table id="resultsTable" class="enhanced-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Score</th>
                                <th>Percentage</th>
                                <th>Performance</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizResults as $result)
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                {{ strtoupper(substr($result->student->name, 0, 1)) }}
                                            </div>
                                            <div class="student-name">{{ $result->student->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $result->score }}</strong> / {{ $result->total_questions }}
                                    </td>
                                    <td>
                                        <span class="score-badge 
                                            @if($result->percentage >= 90) score-excellent
                                            @elseif($result->percentage >= 75) score-good
                                            @elseif($result->percentage >= 60) score-average
                                            @else score-poor
                                            @endif">
                                            {{ $result->percentage }}%
                                        </span>
                                    </td>
                                    <td>
                                        @if($result->percentage >= 90)
                                            <span class="badge badge-success">Excellent</span>
                                        @elseif($result->percentage >= 75)
                                            <span class="badge badge-info">Good</span>
                                        @elseif($result->percentage >= 60)
                                            <span class="badge badge-warning">Average</span>
                                        @else
                                            <span class="badge badge-danger">Needs Improvement</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i>
                                            {{ $result->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-chart-bar"></i>
                        <h4>No Results Yet</h4>
                        <p>No students have submitted this quiz yet. Results will appear here once students complete the quiz.</p>
                        <div class="mt-4">
                            <a href="{{ route('quizzes.uploadResultsForm', $quiz->id) }}" class="btn btn-primary">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Manual Results
                            </a>
                        </div>
                    </div>
                @endif
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Enhanced Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable with enhanced features
    @if(count($quizResults) > 0)
        $('#resultsTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 25,
            order: [[2, 'desc']], // Sort by percentage descending
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i> Copy',
                    className: 'btn btn-info btn-sm'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-secondary btn-sm'
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"B>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            language: {
                search: '<i class="fas fa-search"></i>',
                searchPlaceholder: 'Search students...',
                lengthMenu: 'Show _MENU_ students',
                info: 'Showing _START_ to _END_ of _TOTAL_ students',
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    previous: '<i class="fas fa-angle-left"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>'
                }
            }
        });
    @endif

    // Export functionality
    window.exportResults = function() {
        Swal.fire({
            title: 'Export Quiz Results',
            text: 'Choose your preferred export format',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fas fa-file-excel"></i> Excel',
            cancelButtonText: '<i class="fas fa-file-pdf"></i> PDF',
            showDenyButton: true,
            denyButtonText: '<i class="fas fa-file-csv"></i> CSV',
            denyButtonColor: '#28a745'
        }).then((result) => {
            if (result.isConfirmed) {
                // Export to Excel
                $('#resultsTable').DataTable().button('.buttons-excel').trigger();
                showNotification('success', 'Excel Export', 'Results exported to Excel successfully!');
            } else if (result.isDenied) {
                // Export to CSV
                $('#resultsTable').DataTable().button('.buttons-csv').trigger();
                showNotification('success', 'CSV Export', 'Results exported to CSV successfully!');
            } else if (result.dismiss !== Swal.DismissReason.cancel) {
                // Export to PDF
                $('#resultsTable').DataTable().button('.buttons-pdf').trigger();
                showNotification('success', 'PDF Export', 'Results exported to PDF successfully!');
            }
        });
    };

    // Notification function
    function showNotification(type, title, message) {
        const config = {
            title: title,
            text: message,
            showConfirmButton: true,
            timer: 3000,
            timerProgressBar: true,
        };

        switch (type) {
            case 'success':
                config.icon = 'success';
                config.iconColor = '#28a745';
                config.confirmButtonColor = '#28a745';
                break;
            case 'error':
                config.icon = 'error';
                config.iconColor = '#dc3545';
                config.confirmButtonColor = '#dc3545';
                break;
            case 'info':
                config.icon = 'info';
                config.iconColor = '#17a2b8';
                config.confirmButtonColor = '#17a2b8';
                break;
        }

        Swal.fire(config);
    }

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe stat cards
    document.querySelectorAll('.stat-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Performance grade tooltips
    document.querySelectorAll('.badge').forEach(badge => {
        badge.setAttribute('data-toggle', 'tooltip');
        const percentage = badge.closest('tr').querySelector('.score-badge').textContent;
        
        let tooltipText = '';
        if (badge.textContent.includes('Excellent')) {
            tooltipText = `Outstanding performance! ${percentage} shows mastery of the subject.`;
        } else if (badge.textContent.includes('Good')) {
            tooltipText = `Good performance! ${percentage} demonstrates solid understanding.`;
        } else if (badge.textContent.includes('Average')) {
            tooltipText = `Average performance. ${percentage} indicates room for improvement.`;
        } else {
            tooltipText = `Needs improvement. ${percentage} suggests additional study required.`;
        }
        
        badge.setAttribute('title', tooltipText);
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    console.log('✅ Enhanced Quiz Results page loaded successfully!');
});

// Grade distribution chart (if Chart.js is available)
@if(count($quizResults) > 0)
    try {
        const ctx = document.getElementById('gradeChart');
        if (ctx && typeof Chart !== 'undefined') {
            const gradeDistribution = {
                excellent: {{ $quizResults->where('percentage', '>=', 90)->count() }},
                good: {{ $quizResults->whereBetween('percentage', [75, 89])->count() }},
                average: {{ $quizResults->whereBetween('percentage', [60, 74])->count() }},
                poor: {{ $quizResults->where('percentage', '<', 60)->count() }}
            };
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Excellent (90%+)', 'Good (75-89%)', 'Average (60-74%)', 'Needs Improvement (<60%)'],
                    datasets: [{
                        data: [gradeDistribution.excellent, gradeDistribution.good, gradeDistribution.average, gradeDistribution.poor],
                        backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    } catch (e) {
        console.log('Chart.js not available for grade distribution chart');
    }
@endif
</script>

@endsection