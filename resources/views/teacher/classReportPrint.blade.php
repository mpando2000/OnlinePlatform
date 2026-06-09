<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Report - Learning Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { font-size: 12px; }
            .table { font-size: 11px; }
        }
        
        .print-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
        }
        
        .print-header h2 {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .print-header h5 {
            color: #6c757d;
            margin-bottom: 10px;
        }
        
        .print-date {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .teacher-badge {
            background: #f8f9fa;
            color: #667eea;
            padding: 8px 15px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
            border: 2px solid #667eea;
        }
        
        .table thead th {
            background-color: #667eea;
            color: white;
            font-weight: 600;
            border: 1px solid #667eea;
        }
        
        .table tbody td {
            border: 1px solid #dee2e6;
            padding: 12px 8px;
        }
        
        .class-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .class-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .class-details h6 {
            margin: 0;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .class-meta {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 2px;
        }
        
        .print-footer {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .stats-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        
        .stats-summary h6 {
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        
        .stat-item {
            text-align: center;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 3px;
        }
        
        @media print {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="print-header">
                    <h2><i class="fas fa-graduation-cap me-2"></i>Learning Management System</h2>
                    <h5><i class="fas fa-chalkboard me-2"></i>Class Data Report - Teacher View</h5>
                    <div class="print-date">
                        <i class="fas fa-calendar me-1"></i>Generated on: {{ date('F d, Y \a\t H:i') }}
                    </div>
                    <div class="teacher-badge">
                        <i class="fas fa-user-graduate me-1"></i>Teacher Access Level
                    </div>
                </div>
                
                <!-- Statistics Summary -->
                <div class="stats-summary">
                    <h6><i class="fas fa-chart-bar me-2"></i>Class Statistics Summary</h6>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ count($classes) }}</div>
                            <div class="stat-label">Total Classes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ App\Models\Subject::count() }}</div>
                            <div class="stat-label">Total Subjects</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ App\Models\User::where('role', 'student')->count() }}</div>
                            <div class="stat-label">Students</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ date('Y') }}</div>
                            <div class="stat-label">Academic Year</div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="TABLE_Class_Report">
                        <thead>
                            <tr>
                                <th style="width: 8%;">#</th>
                                <th style="width: 60%;">Class Information</th>
                                <th style="width: 32%;">Creation Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                            <tr>
                                <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <div class="class-info">
                                        <div class="class-icon">
                                            {{ substr($class->name, 0, 1) }}
                                        </div>
                                        <div class="class-details">
                                            <h6>{{ $class->name }}</h6>
                                            <div class="class-meta">
                                                <i class="fas fa-graduation-cap me-1"></i>Academic Class
                                                @if($class->subjects && $class->subjects->count() > 0)
                                                    • {{ $class->subjects->count() }} Subjects
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $class->created_at ? $class->created_at->format('M d, Y') : 'Not Available' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="print-footer">
                    <p><strong>Total Classes: {{ count($classes) }}</strong></p>
                    <p>© {{ date('Y') }} Learning Management System. All rights reserved.</p>
                    <p><small>This report was generated for teacher access with appropriate visibility permissions.</small></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            // Small delay to ensure page is fully loaded
            setTimeout(function() {
                window.print();
                
                // Optional: redirect back after printing (uncomment if needed)
                // window.onafterprint = function() {
                //     window.history.back();
                // };
            }, 500);
        };
        
        console.log('Teacher Class Report print page loaded successfully');
    </script>
</body>
</html>
