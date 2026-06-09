@extends('components.dashmaster')

@section('body')
<style>
    .school-detail-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .content-header h1 {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .breadcrumb-item a {
        color: #28a745;
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: #20c997;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
    }
    
    .school-header {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.6s ease;
        position: relative;
        overflow: hidden;
    }
    
    .school-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .school-title {
        color: #2c3e50;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    
    .school-title i {
        margin-right: 15px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .school-code {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 15px;
    }
    
    .school-description {
        color: #7f8c8d;
        font-size: 1.2rem;
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .status-badge {
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
    }
    
    .status-badge i {
        margin-right: 8px;
        font-size: 1rem;
    }
    
    .status-active {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    
    .status-inactive {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }
    
    .info-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .info-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        position: relative;
        overflow: hidden;
    }
    
    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .card-icon {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-right: 15px;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
    }
    
    .card-title {
        color: #2c3e50;
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }
    
    .card-content {
        color: #7f8c8d;
        font-size: 1rem;
        line-height: 1.6;
    }
    
    .card-content strong {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .empty-state {
        text-align: center;
        color: #95a5a6;
        font-style: italic;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-top: 10px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px 15px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        animation: fadeInUp 0.8s ease;
        border: 2px solid #f8f9fa;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        border-color: #28a745;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 5px;
        display: block;
        word-break: break-all;
        line-height: 1.2;
    }
    
    .stat-label {
        color: #7f8c8d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        line-height: 1.3;
    }
    
    .action-buttons {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        animation: fadeInUp 1s ease;
    }
    
    .modern-btn {
        padding: 15px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 10px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    
    .modern-btn i {
        margin-right: 8px;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }
    
    .btn-edit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 123, 255, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    
    .btn-delete:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(220, 53, 69, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-back {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
        text-decoration: none;
    }
    
    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .created-info {
        background: #f8f9fa;
        border-left: 4px solid #28a745;
        padding: 15px 20px;
        margin-top: 20px;
        border-radius: 0 10px 10px 0;
        color: #6c757d;
        font-size: 0.9rem;
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
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<div class="content-wrapper school-detail-container">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>School Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.schools.index') }}">Schools</a></li>
                            <li class="breadcrumb-item active">{{ $school->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- School Header -->
        <div class="school-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="school-code">{{ $school->code }}</div>
                    <h1 class="school-title">
                        <i class="fas fa-school"></i>
                        {{ $school->name }}
                    </h1>
                    @if($school->description)
                        <p class="school-description">{{ $school->description }}</p>
                    @else
                        <p class="school-description">No description provided for this school.</p>
                    @endif
                    <div class="status-badge status-{{ $school->status }}">
                        <i class="fas fa-{{ $school->status == 'active' ? 'check-circle' : 'pause-circle' }}"></i>
                        {{ ucfirst($school->status) }}
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="created-info">
                        <strong>Created:</strong> {{ $school->created_at->format('M d, Y') }}<br>
                        <strong>Updated:</strong> {{ $school->updated_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
        </div>

                <!-- Statistics Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-number">{{ $school->users()->count() }}</span>
                        <span class="stat-label">Total Users</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">{{ $school->users()->where('role', 'student')->count() }}</span>
                        <span class="stat-label">Students</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">{{ $school->users()->where('role', 'teacher')->count() }}</span>
                        <span class="stat-label">Teachers</span>
                    </div>
                    <div class="stat-card">
                        @php
                            $daysActive = $school->created_at->diffInDays(now());
                            $displayDays = $daysActive > 9999 ? '9999+' : $daysActive;
                        @endphp
                        <span class="stat-number" title="{{ $daysActive }} days active">{{ $displayDays }}</span>
                        <span class="stat-label">Days Active</span>
                    </div>
                </div>

        <!-- Information Cards -->
        <div class="info-cards-grid">
            <!-- Contact Information Card -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <h3 class="card-title">Contact Information</h3>
                </div>
                <div class="card-content">
                    @if($school->address || $school->phone || $school->email)
                        @if($school->address)
                            <p><strong>Address:</strong><br>{{ $school->address }}</p>
                        @endif
                        @if($school->phone)
                            <p><strong>Phone:</strong> {{ $school->phone }}</p>
                        @endif
                        @if($school->email)
                            <p><strong>Email:</strong> {{ $school->email }}</p>
                        @endif
                    @else
                        <div class="empty-state">
                            <i class="fas fa-info-circle"></i>
                            No contact information available
                        </div>
                    @endif
                </div>
            </div>

            <!-- School Status Card -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <h3 class="card-title">Status Information</h3>
                </div>
                <div class="card-content">
                    <p><strong>Current Status:</strong> 
                        <span class="status-badge status-{{ $school->status }}">
                            <i class="fas fa-{{ $school->status == 'active' ? 'check-circle' : 'pause-circle' }}"></i>
                            {{ ucfirst($school->status) }}
                        </span>
                    </p>
                    <p><strong>Status Description:</strong><br>
                        @if($school->status == 'active')
                            This school is currently operational and accepting new students and staff.
                        @else
                            This school is currently inactive and not accepting new registrations.
                        @endif
                    </p>
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="card-title">Recent Activity</h3>
                </div>
                <div class="card-content">
                    <p><strong>Last Updated:</strong> {{ $school->updated_at->diffForHumans() }}</p>
                    <p><strong>Created:</strong> {{ $school->created_at->format('F j, Y \a\t g:i A') }}</p>
                    <p><strong>Age:</strong> {{ $school->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- System Information Card -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3 class="card-title">System Information</h3>
                </div>
                <div class="card-content">
                    <p><strong>School ID:</strong> #{{ $school->id }}</p>
                    <p><strong>Unique Code:</strong> {{ $school->code }}</p>
                    <p><strong>Database Record:</strong> {{ $school->getTable() }}</p>
                    <p><strong>Model:</strong> {{ class_basename($school) }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('admin.schools.edit', $school) }}" class="modern-btn btn-edit">
                <i class="fas fa-edit"></i>
                Edit School
            </a>
            
            <form action="{{ route('admin.schools.destroy', $school) }}" method="POST" class="d-inline-block" 
                  onsubmit="return confirm('Are you sure you want to delete this school? This action cannot be undone and will affect all associated users.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="modern-btn btn-delete">
                    <i class="fas fa-trash"></i>
                    Delete School
                </button>
            </form>
            
            <a href="{{ route('admin.schools.index') }}" class="modern-btn btn-back">
                <i class="fas fa-list"></i>
                Back to List
            </a>
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

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>

@endsection
