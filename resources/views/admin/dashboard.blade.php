@extends('components.dashmaster')

@section('body')

<style>
.admin-dashboard {
    background: #f5f7fb;
    min-height: 100vh;
}

.admin-shell {
    padding: 18px;
}

.admin-page-header {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 16px;
    padding: 16px 18px;
}

.admin-page-title {
    color: #172033;
    font-size: 22px;
    font-weight: 700;
    margin: 0;
}

.admin-page-subtitle {
    color: #6b7280;
    margin: 4px 0 0;
}

.admin-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.admin-action {
    align-items: center;
    background: #123d35;
    border-radius: 6px;
    color: #fff;
    display: inline-flex;
    font-weight: 700;
    gap: 8px;
    min-height: 38px;
    padding: 8px 12px;
}

.admin-action:hover {
    background: #1f6f5b;
    color: #fff;
    text-decoration: none;
}

.stats-grid {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    margin-bottom: 16px;
}

.stat-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-left: 4px solid var(--accent, #123d35);
    border-radius: 8px;
    min-height: 108px;
    padding: 14px;
}

.stat-row {
    align-items: center;
    display: flex;
    gap: 12px;
}

.stat-icon {
    align-items: center;
    background: color-mix(in srgb, var(--accent, #123d35) 13%, white);
    border-radius: 8px;
    color: var(--accent, #123d35);
    display: flex;
    height: 42px;
    justify-content: center;
    width: 42px;
}

.stat-value {
    color: #172033;
    font-size: 24px;
    font-weight: 800;
    line-height: 1;
    margin: 0;
}

.stat-label {
    color: #6b7280;
    font-size: 13px;
    margin: 4px 0 0;
}

.stat-link {
    color: var(--accent, #123d35);
    display: inline-flex;
    font-size: 13px;
    font-weight: 700;
    gap: 6px;
    margin-top: 12px;
}

.content-grid {
    display: grid;
    gap: 14px;
    grid-template-columns: minmax(0, 1.5fr) minmax(280px, .8fr);
}

.panel {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}

.panel-header {
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    color: #172033;
    display: flex;
    font-size: 15px;
    font-weight: 800;
    gap: 8px;
    padding: 13px 16px;
}

.panel-body {
    padding: 14px 16px;
}

.table-clean {
    margin: 0;
}

.table-clean th {
    border-top: 0;
    color: #6b7280;
    font-size: 12px;
    text-transform: uppercase;
}

.table-clean td {
    color: #374151;
    vertical-align: middle;
}

.role-pill {
    background: #eef2ff;
    border-radius: 999px;
    color: #3730a3;
    display: inline-block;
    font-size: 12px;
    font-weight: 800;
    padding: 4px 9px;
}

.summary-list {
    display: grid;
    gap: 10px;
}

.summary-item {
    align-items: center;
    border: 1px solid #edf0f4;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    padding: 10px 12px;
}

.summary-item span {
    color: #6b7280;
}

.summary-item strong {
    color: #172033;
}

@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>

<div class="content-wrapper admin-dashboard">
    <section class="content">
        <div class="container-fluid admin-shell">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Admin Dashboard</h1>
                    <p class="admin-page-subtitle">Simple overview of users, schools, classes, and quizzes.</p>
                </div>
                <div class="admin-actions">
                    <a href="{{ route('admin.users') }}" class="admin-action"><i class="fas fa-users"></i> Users</a>
                    <a href="{{ route('admin.schools.index') }}" class="admin-action"><i class="fas fa-school"></i> Schools</a>
                    <a href="{{ route('admin.report') }}" class="admin-action"><i class="fas fa-chart-bar"></i> Reports</a>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card" style="--accent:#0f766e;">
                    <div class="stat-row">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div>
                            <p class="stat-value">{{ $stat['usersCount'] }}</p>
                            <p class="stat-label">Total Users</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users') }}" class="stat-link">Manage users <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card" style="--accent:#4f46e5;">
                    <div class="stat-row">
                        <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                        <div>
                            <p class="stat-value">{{ $stat['studentsCount'] }}</p>
                            <p class="stat-label">Students</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users') }}" class="stat-link">View students <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card" style="--accent:#b91c1c;">
                    <div class="stat-row">
                        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <div>
                            <p class="stat-value">{{ $stat['teachersCount'] }}</p>
                            <p class="stat-label">Teachers</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users') }}" class="stat-link">View teachers <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card" style="--accent:#c2410c;">
                    <div class="stat-row">
                        <div class="stat-icon"><i class="fas fa-school"></i></div>
                        <div>
                            <p class="stat-value">{{ $stat['schoolsCount'] }}</p>
                            <p class="stat-label">Active Schools</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.schools.index') }}" class="stat-link">Manage schools <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card" style="--accent:#15803d;">
                    <div class="stat-row">
                        <div class="stat-icon"><i class="fas fa-door-open"></i></div>
                        <div>
                            <p class="stat-value">{{ $stat['classCount'] }}</p>
                            <p class="stat-label">Classes</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.classes') }}" class="stat-link">Manage classes <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card" style="--accent:#be185d;">
                    <div class="stat-row">
                        <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
                        <div>
                            <p class="stat-value">{{ $stat['quizzesCount'] ?? 0 }}</p>
                            <p class="stat-label">Quizzes</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.quizzes.index') }}" class="stat-link">Manage quizzes <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="content-grid">
                <div class="panel">
                    <div class="panel-header"><i class="fas fa-clock"></i> Recent User Registrations</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-clean">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentUsers as $user)
                                        <tr>
                                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><span class="role-pill">{{ ucfirst($user->role) }}</span></td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No recent registrations</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header"><i class="fas fa-list-check"></i> System Summary</div>
                    <div class="panel-body">
                        <div class="summary-list">
                            <div class="summary-item">
                                <span>Inactive Users</span>
                                <strong>{{ $stat['inactiveCount'] }}</strong>
                            </div>
                            <div class="summary-item">
                                <span>Active Users Today</span>
                                <strong>{{ $stat['activeUsers'] ?? 0 }}</strong>
                            </div>
                            <div class="summary-item">
                                <span>Recent Registrations</span>
                                <strong>{{ $stat['recentRegistrations'] ?? 0 }}</strong>
                            </div>
                            <div class="summary-item">
                                <span>Schools Listed</span>
                                <strong>{{ count($schoolStats) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<footer class="main-footer" style="background: white; border-top: 1px solid #e5e7eb;">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong>
    All rights reserved.
</footer>

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
@endsection
