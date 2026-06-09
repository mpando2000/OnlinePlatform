@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chart-bar"></i> Quiz Results</h1>
                <p>{{ $quiz->title }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.quizzes.uploadResults.form', $quiz) }}" class="ui-btn ui-btn-primary"><i class="fas fa-upload"></i> Upload Results</a>
                <a href="{{ route('admin.quizzes.downloadTemplate', $quiz) }}" class="ui-btn ui-btn-light"><i class="fas fa-file-download"></i> Template</a>
                <a href="{{ route('admin.quizzes.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Quizzes</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="stats-grid">
            <div class="stat-card"><span>Students</span><strong>{{ $quizResults->count() }}</strong></div>
            <div class="stat-card"><span>Average</span><strong>{{ number_format($quizResults->avg('percentage') ?? 0, 1) }}%</strong></div>
            <div class="stat-card"><span>Highest</span><strong>{{ number_format($quizResults->max('percentage') ?? 0, 1) }}%</strong></div>
            <div class="stat-card"><span>Passed</span><strong>{{ $quizResults->where('percentage', '>=', 50)->count() }}</strong></div>
        </div>

        <div class="table-card">
            <div class="table-title">
                <strong>Student Results</strong>
                <span>{{ $quizResults->count() }} records</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>School</th>
                            <th>Class</th>
                            <th>Score</th>
                            <th>Percentage</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizResults as $result)
                            @php
                                $student = $result->student;
                                $percentage = $result->percentage ?? 0;
                                $grade = $percentage >= 90 ? 'A' : ($percentage >= 80 ? 'B+' : ($percentage >= 70 ? 'B' : ($percentage >= 60 ? 'C+' : ($percentage >= 50 ? 'C' : ($percentage >= 40 ? 'D' : 'F')))));
                                $schoolName = 'No School';
                                if ($student && isset($student->schoolModel) && $student->schoolModel) {
                                    $schoolName = $student->schoolModel->name;
                                } elseif ($student && !empty($student->getAttributes()['school'])) {
                                    $schoolName = ucfirst($student->getAttributes()['school']);
                                }
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ optional($student)->firstname }} {{ optional($student)->secondname }} {{ optional($student)->lastname }}</strong>
                                    <span>{{ optional($student)->email }}</span>
                                </td>
                                <td>{{ $schoolName }}</td>
                                <td>{{ optional(optional($student)->schoolClass)->name ?? 'N/A' }}</td>
                                <td>{{ $result->score ?? 0 }} / {{ $result->total_questions ?? 0 }}</td>
                                <td><span class="score-pill {{ $percentage >= 50 ? 'score-pass' : 'score-fail' }}">{{ number_format($percentage, 1) }}%</span></td>
                                <td><strong>{{ $grade }}</strong></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="empty-cell">No results uploaded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.quiz.partials.clean-styles')
<style>
.score-pill { border-radius: 999px; display: inline-block; font-size: 12px; font-weight: 800; padding: 5px 9px; }
.score-pass { background: #ecfdf5; color: #047857; }
.score-fail { background: #fef2f2; color: #b91c1c; }
</style>
@endsection
