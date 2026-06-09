
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report - Learning Management System</title>
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
        
        .table thead th {
            background-color: #667eea;
            color: white;
            font-weight: 600;
            border: 1px solid #667eea;
        }
        
        .table tbody td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        
        .role-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .role-badge.admin { background-color: #dc3545; color: white; }
        .role-badge.teacher { background-color: #28a745; color: white; }
        .role-badge.student { background-color: #007bff; color: white; }
        
        .print-footer {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="print-header">
                    <h2><i class="fas fa-graduation-cap me-2"></i>Learning Management System</h2>
                    <h5><i class="fas fa-users me-2"></i>User Data Report</h5>
                    <div class="print-date">
                        <i class="fas fa-calendar me-1"></i>Generated on: {{ date('F d, Y \a\t H:i') }}
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="TABLE_Report_2">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">First Name</th>
                                <th style="width: 15%;">Second Name</th>
                                <th style="width: 15%;">Last Name</th>
                                <th style="width: 25%;">Email</th>
                                <th style="width: 10%;">Role</th>
                                <th style="width: 15%;">Time Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->secondname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge {{ strtolower($user->role) }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $user->getTimeSpentAttribute() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="print-footer">
                    <p><strong>Total Users: {{ count($users) }}</strong></p>
                    <p>© {{ date('Y') }} Learning Management System. All rights reserved.</p>
                    <p><small>This report was generated automatically. For questions, contact the system administrator.</small></p>
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
        
        // Prevent calendar initialization since it's not needed for print
        console.log('Print page loaded successfully');
    </script>
</body>
</html>