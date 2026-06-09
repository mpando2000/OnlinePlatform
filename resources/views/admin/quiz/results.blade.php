
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
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
    color: #28a745;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
    margin-bottom: 20px;
}

.quiz-info-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 4px solid #28a745;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.quiz-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.quiz-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

.action-buttons {
    display: flex;
    gap: 15px;
    align-items: center;
    margin-top: 20px;
}

.upload-btn {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
}

.upload-btn i {
    margin-right: 8px;
}

.stats-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    text-align: center;
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
    background: linear-gradient(135deg, var(--stat-color, #28a745), var(--stat-color-dark, #20c997));
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.stat-card.total-students {
    --stat-color: #3498db;
    --stat-color-dark: #2980b9;
}

.stat-card.average-score {
    --stat-color: #28a745;
    --stat-color-dark: #20c997;
}

.stat-card.highest-score {
    --stat-color: #f39c12;
    --stat-color-dark: #e67e22;
}

.stat-card.passing-rate {
    --stat-color: #9b59b6;
    --stat-color-dark: #8e44ad;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 10px 0 5px 0;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
}

.results-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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

.enhanced-table tbody tr:hover {
    background: #f8f9fa;
}

.student-name {
    font-weight: 600;
    color: #2c3e50;
}

.school-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
}

.school-jitegemee {
    background: #e3f2fd;
    color: #1976d2;
}

.school-kawawa {
    background: #f3e5f5;
    color: #7b1fa2;
}

.school-makongo, .school-makongo-secondary-school {
    background: #e8f5e8;
    color: #388e3c;
}

.school-jitegemee-secondary-school {
    background: #e3f2fd;
    color: #1976d2;
}

.school-kawawa-secondary-school {
    background: #f3e5f5;
    color: #7b1fa2;
}

.school-default, .school-no-school {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.class-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    background: #fff3cd;
    color: #856404;
    text-transform: capitalize;
}

.subject-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    background: #e7f3ff;
    color: #0066cc;
    text-transform: capitalize;
}

.percentage-badge {
    padding: 6px 15px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.percentage-excellent {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.percentage-good {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
}

.percentage-average {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: white;
}

.percentage-poor {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.no-results i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #dee2e6;
}

.no-results h4 {
    margin-bottom: 10px;
    color: #495057;
}

/* Responsive design */
@media (max-width: 768px) {
    .stats-summary {
        grid-template-columns: 1fr;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .enhanced-table {
        font-size: 0.85rem;
    }
}

/* DataTables custom styling */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
    color: #495057;
    margin: 15px 0;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5rem 1rem;
    margin: 0 2px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    background: white;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #28a745;
    border-color: #28a745;
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #28a745;
    border-color: #28a745;
    color: white !important;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper quiz-results-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-chart-bar"></i>
                Quiz Results
            </h1>
            <p class="page-subtitle">View and analyze quiz performance results</p>
            
            <!-- Quiz Information Card -->
            <div class="quiz-info-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="quiz-title">{{ $quiz->title ?? 'Quiz Results' }}</h4>
                        <p class="quiz-description">{{ $quiz->description ?? 'Detailed results and performance analytics' }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="action-buttons">
                            <a href="{{ route('admin.quizzes.uploadResults.form', $quiz->id) }}" class="upload-btn">
                                <i class="fas fa-upload"></i>
                                Upload Quiz Results
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Summary -->
            <div class="stats-summary">
                <div class="stat-card total-students">
                    <div class="stat-number">{{ $quizResults->count() }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card average-score">
                    <div class="stat-number">{{ number_format($quizResults->avg('percentage'), 1) }}%</div>
                    <div class="stat-label">Average Score</div>
                </div>
                <div class="stat-card highest-score">
                    <div class="stat-number">{{ $quizResults->max('percentage') ?? 0 }}%</div>
                    <div class="stat-label">Highest Score</div>
                </div>
                <div class="stat-card passing-rate">
                    @php
                        $passingCount = $quizResults->where('percentage', '>=', 50)->count();
                        $passingRate = $quizResults->count() > 0 ? ($passingCount / $quizResults->count()) * 100 : 0;
                    @endphp
                    <div class="stat-number">{{ number_format($passingRate, 1) }}%</div>
                    <div class="stat-label">Passing Rate</div>
                </div>
            </div>
        </div>

        <!-- Results Table Section -->
        <div class="results-section">
            <div class="section-header">
                <div>
                    <i class="fas fa-table"></i>
                    Student Results
                </div>
                <div>
                    <small>{{ $quizResults->count() }} results found</small>
                </div>
            </div>

            <div class="table-container">
                @if($quizResults->count() > 0)
                    <table id="example1" class="enhanced-table table table-hover">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>School</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizResults as $quizResult)
                                <tr>
                                    <td>
                                        <div class="student-name">
                                            {{ $quizResult->student->firstname }} 
                                            {{ $quizResult->student->secondname }} 
                                            {{ $quizResult->student->lastname }}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $schoolName = 'No School';
                                            $schoolClass = 'school-default';
                                            
                                            // Try to get school from manually loaded school model first
                                            if(isset($quizResult->student->schoolModel) && $quizResult->student->schoolModel) {
                                                $schoolName = $quizResult->student->schoolModel->name;
                                                $schoolClass = 'school-' . strtolower(str_replace(' ', '-', $schoolName));
                                            } 
                                            // Fallback to old school field (for legacy users)
                                            else {
                                                $legacySchool = $quizResult->student->getAttributes()['school'] ?? null;
                                                if(!empty($legacySchool) && is_string($legacySchool)) {
                                                    $schoolName = ucfirst($legacySchool);
                                                    $schoolClass = 'school-' . strtolower($legacySchool);
                                                }
                                            }
                                        @endphp
                                        <span class="school-badge {{ $schoolClass }}">
                                            {{ $schoolName }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="class-badge">
                                            {{ $quizResult->student->schoolClass->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="subject-badge">
                                            @php
                                                $subjectName = 'N/A';
                                                
                                                // Try to get subject from the quiz first (most likely)
                                                if(isset($quiz->subject) && $quiz->subject) {
                                                    $subjectName = $quiz->subject->name ?? $quiz->subject;
                                                }
                                                // Try to get from student's subjects relationship
                                                elseif($quizResult->student->subjects && $quizResult->student->subjects->count() > 0) {
                                                    $subjectName = $quizResult->student->subjects->first()->name;
                                                }
                                                // Try to get from quiz result's quiz relationship
                                                elseif(isset($quizResult->quiz) && isset($quizResult->quiz->subject)) {
                                                    $subjectName = $quizResult->quiz->subject->name ?? $quizResult->quiz->subject;
                                                }
                                                // Fallback: try direct field access
                                                elseif(isset($quizResult->student->subject) && $quizResult->student->subject) {
                                                    $subjectName = $quizResult->student->subject;
                                                }
                                            @endphp
                                            {{ $subjectName }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $percentage = $quizResult->percentage;
                                            $badgeClass = 'percentage-poor';
                                            if ($percentage >= 90) {
                                                $badgeClass = 'percentage-excellent';
                                            } elseif ($percentage >= 75) {
                                                $badgeClass = 'percentage-good';
                                            } elseif ($percentage >= 50) {
                                                $badgeClass = 'percentage-average';
                                            }
                                        @endphp
                                        <span class="percentage-badge {{ $badgeClass }}">
                                            {{ $percentage }}%
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            if ($percentage >= 90) echo 'A';
                                            elseif ($percentage >= 80) echo 'B+';
                                            elseif ($percentage >= 70) echo 'B';
                                            elseif ($percentage >= 60) echo 'C+';
                                            elseif ($percentage >= 50) echo 'C';
                                            elseif ($percentage >= 40) echo 'D+';
                                            elseif ($percentage >= 30) echo 'D';
                                            else echo 'F';
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-results">
                        <i class="fas fa-chart-line-down"></i>
                        <h4>No Results Found</h4>
                        <p>No quiz results have been uploaded yet. Click the "Upload Quiz Results" button to add student results.</p>
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
        <b>Quiz Results</b> Management System
    </div>
</footer>

<!-- Enhanced Scripts -->
<script>
$(function () {
    // Initialize DataTable with enhanced features
    const table = $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
                text: '<i class="fas fa-file-pdf"></i> PDF',
                customize: function (doc) {
                    doc.content[1].table.widths = ['20%', '15%', '15%', '15%', '15%', '20%'];
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 11;
                    doc.styles.title.fontSize = 16;
                }
            },
            {
                extend: 'print',
                className: 'btn btn-info',
                text: '<i class="fas fa-print"></i> Print'
            },
            {
                extend: 'colvis',
                className: 'btn btn-warning',
                text: '<i class="fas fa-columns"></i> Columns'
            }
        ],
        "order": [[4, "desc"]], // Sort by percentage descending by default
        "columnDefs": [
            {
                "targets": 4, // Percentage column
                "type": "num-fmt"
            }
        ],
        "language": {
            "search": "Search results:",
            "lengthMenu": "Show _MENU_ results per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ results",
            "infoEmpty": "No results to display",
            "infoFiltered": "(filtered from _MAX_ total results)",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        }
    });

    // Add buttons to the table wrapper
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // Add custom styling to buttons
    $('.dt-buttons .btn').addClass('btn-sm me-1 mb-2');

    // Set current year in footer
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Add tooltips to percentage badges
    $('[data-toggle="tooltip"]').tooltip();

    // Add loading animation when exporting
    table.on('buttons-action', function (e, buttonApi, dataTable, node, config) {
        if (config.extend !== 'colvis') {
            const button = $(node);
            const originalText = button.html();
            button.html('<i class="fas fa-spinner fa-spin"></i> Processing...');
            button.prop('disabled', true);
            
            setTimeout(function() {
                button.html(originalText);
                button.prop('disabled', false);
            }, 2000);
        }
    });

    // Add search highlighting
    table.on('draw', function () {
        const searchTerm = table.search();
        if (searchTerm) {
            const searchRegex = new RegExp('(' + searchTerm + ')', 'gi');
            $('#example1 tbody td').each(function() {
                const cellContent = $(this).html();
                if (cellContent.indexOf('<') === -1) { // Avoid replacing HTML tags
                    $(this).html(cellContent.replace(searchRegex, '<mark>$1</mark>'));
                }
            });
        }
    });

    // Add performance analytics
    const totalResults = {{ $quizResults->count() }};
    const averageScore = {{ $quizResults->avg('percentage') ?? 0 }};
    
    if (totalResults > 0) {
        console.log(`Quiz Analytics: ${totalResults} students, ${averageScore.toFixed(1)}% average score`);
    }
});

// Custom function to format percentage display
function formatPercentage(percentage) {
    let className = 'percentage-poor';
    if (percentage >= 90) className = 'percentage-excellent';
    else if (percentage >= 75) className = 'percentage-good';
    else if (percentage >= 50) className = 'percentage-average';
    
    return `<span class="percentage-badge ${className}">${percentage}%</span>`;
}

// Add smooth animations to stat cards
$(document).ready(function() {
    $('.stat-card').each(function(index) {
        $(this).delay(index * 100).animate({
            opacity: 1,
            transform: 'translateY(0)'
        }, 500);
    });
});
</script>

@endsection