@extends('components.dashmaster')

@section('body')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<style>
/* Enhanced Quiz View Styling */
.view-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.quiz-header {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 40px 30px;
    animation: fadeInDown 0.8s ease;
    position: relative;
    overflow: hidden;
}

.quiz-header::before {
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

.quiz-title {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
}

.quiz-title i {
    margin-right: 15px;
    color: #9b59b6;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.quiz-description {
    color: #7f8c8d;
    font-size: 1.2rem;
    margin: 0 0 25px 0;
    position: relative;
    z-index: 1;
    line-height: 1.6;
}

.quiz-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    position: relative;
    z-index: 1;
}

.quiz-badge {
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.badge-file {
    background: linear-gradient(45deg, #e67e22, #f39c12);
}

.badge-created {
    background: linear-gradient(45deg, #2ecc71, #27ae60);
}

.badge-status {
    background: linear-gradient(45deg, #3498db, #2980b9);
}

.info-cards-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.info-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    animation: fadeInUp 0.8s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.info-card-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.info-card-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 15px;
}

.icon-details { background: linear-gradient(135deg, #667eea, #764ba2); }
.icon-schedule { background: linear-gradient(135deg, #f093fb, #f5576c); }
.icon-participants { background: linear-gradient(135deg, #4facfe, #00f2fe); }
.icon-stats { background: linear-gradient(135deg, #43e97b, #38f9d7); }

.info-card-title {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    padding: 8px 0;
}

.info-item i {
    width: 20px;
    color: #667eea;
    margin-right: 10px;
}

.info-item strong {
    color: #2c3e50;
    min-width: 100px;
    display: inline-block;
}

.info-value {
    color: #5a6c7d;
}

.quiz-content-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
}

.content-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px 30px;
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.content-header i {
    margin-right: 12px;
    font-size: 1.2rem;
}

.content-body {
    padding: 30px;
}

.file-preview {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px dashed #667eea;
    border-radius: 15px;
    padding: 40px;
    text-align: center;
    margin: 20px 0;
}

.file-icon {
    font-size: 4rem;
    color: #667eea;
    margin-bottom: 20px;
}

.file-info h4 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
}

.file-info p {
    color: #7f8c8d;
    margin-bottom: 20px;
}

.file-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.question-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    animation: fadeInUp 0.5s ease;
}

.question-card:hover {
    border-color: #667eea;
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.question-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.question-number {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 15px;
}

.question-text {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.2rem;
    flex: 1;
    line-height: 1.4;
}

.options-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    margin: 20px 0;
}

.option-item {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 15px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.option-item.correct {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-color: #27ae60;
    color: #155724;
}

.option-label {
    background: #667eea;
    color: white;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    font-weight: 600;
    margin-right: 10px;
    min-width: 25px;
}

.option-item.correct .option-label {
    background: #27ae60;
}

.option-text {
    flex: 1;
    font-weight: 500;
}

.correct-indicator {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    padding: 5px 15px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-top: 15px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.action-buttons {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 20px;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
}

.btn-action {
    padding: 12px 25px;
    border: none;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    text-decoration: none;
}

.btn-action i {
    margin-right: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
}

.btn-info {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
}

.btn-warning {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
}

.back-btn {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    margin-bottom: 20px;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
    color: white;
    text-decoration: none;
}

.back-btn i {
    margin-right: 8px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.stat-item {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-item:hover {
    border-color: #667eea;
    transform: translateY(-2px);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    display: block;
}

.stat-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-top: 5px;
}

.empty-state {
    text-align: center;
    padding: 40px;
    color: #7f8c8d;
}

.empty-state i {
    font-size: 4rem;
    color: #bdc3c7;
    margin-bottom: 20px;
    display: block;
}

/* Animation Classes */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

/* Responsive Design */
@media (max-width: 768px) {
    .quiz-title {
        font-size: 2rem;
        flex-direction: column;
        text-align: center;
    }
    
    .info-cards-container {
        grid-template-columns: 1fr;
    }
    
    .options-container {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-action {
        justify-content: center;
    }
}

/* Print Styles */
@media print {
    .action-buttons, .back-btn {
        display: none !important;
    }
}
</style>

<div class="content-wrapper">
    <div class="view-container">
        <div class="container-fluid">
            <!-- Back Button -->
            <a href="{{ route('admin.quizzes.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Quiz Management
            </a>

            <!-- Quiz Header -->
            <div class="quiz-header">
                <h1 class="quiz-title">
                    <i class="fas fa-{{ $quiz->quiz_file ? 'file-upload' : 'question-circle' }}"></i>
                    {{ $quiz->title }}
                </h1>
                <p class="quiz-description">{{ $quiz->description }}</p>
                
                <div class="quiz-badges">
                    @if($quiz->quiz_file)
                        <div class="quiz-badge badge-file">
                            <i class="fas fa-file"></i>
                            File-based Quiz
                        </div>
                    @else
                        <div class="quiz-badge badge-created">
                            <i class="fas fa-plus-circle"></i>
                            Created Quiz
                        </div>
                    @endif
                    
                    <div class="quiz-badge badge-status">
                        <i class="fas fa-{{ now()->between($quiz->start_time, $quiz->end_time) ? 'play' : (now() > $quiz->end_time ? 'stop' : 'clock') }}"></i>
                        @if(now()->between($quiz->start_time, $quiz->end_time))
                            Active
                        @elseif(now() > $quiz->end_time)
                            Ended
                        @else
                            Upcoming
                        @endif
                    </div>
                </div>
            </div>

            <!-- Information Cards -->
            <div class="info-cards-container">
                <!-- Quiz Details -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-details">
                            <i class="fas fa-info"></i>
                        </div>
                        <h3 class="info-card-title">Quiz Details</h3>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-chalkboard"></i>
                        <strong>Class:</strong>
                        <span class="info-value">{{ $quiz->class->name }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-book"></i>
                        <strong>Subject:</strong>
                        <span class="info-value">{{ $quiz->subject->name }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-hourglass-half"></i>
                        <strong>Duration:</strong>
                        <span class="info-value">{{ $quiz->duration }} minutes</span>
                    </div>
                    @if($quiz->quiz_file)
                        <div class="info-item">
                            <i class="fas fa-file"></i>
                            <strong>File Type:</strong>
                            <span class="info-value">{{ strtoupper(pathinfo($quiz->quiz_file, PATHINFO_EXTENSION)) }}</span>
                        </div>
                    @else
                        <div class="info-item">
                            <i class="fas fa-question-circle"></i>
                            <strong>Questions:</strong>
                            <span class="info-value">{{ $quiz->questions->count() }} questions</span>
                        </div>
                    @endif
                </div>

                <!-- Schedule Information -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-schedule">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <h3 class="info-card-title">Schedule</h3>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-play"></i>
                        <strong>Start:</strong>
                        <span class="info-value">{{ \Carbon\Carbon::parse($quiz->start_time)->format('M d, Y - h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-stop"></i>
                        <strong>End:</strong>
                        <span class="info-value">{{ \Carbon\Carbon::parse($quiz->end_time)->format('M d, Y - h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <strong>Status:</strong>
                        <span class="info-value">
                            @if(now()->between($quiz->start_time, $quiz->end_time))
                                <span style="color: #27ae60;">🟢 Currently Active</span>
                            @elseif(now() > $quiz->end_time)
                                <span style="color: #e74c3c;">🔴 Ended</span>
                            @else
                                <span style="color: #f39c12;">🟡 Upcoming</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-plus"></i>
                        <strong>Created:</strong>
                        <span class="info-value">{{ $quiz->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <!-- Participants & Stats -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-participants">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="info-card-title">Participation</h3>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{{ $quiz->quiz_results ? $quiz->quiz_results->count() : 0 }}</span>
                            <span class="stat-label">Submissions</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">
                                @if($quiz->quiz_results && $quiz->quiz_results->count() > 0)
                                    {{ number_format($quiz->quiz_results->avg('score'), 1) }}%
                                @else
                                    N/A
                                @endif
                            </span>
                            <span class="stat-label">Avg. Score</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quiz Content -->
            <div class="quiz-content-card">
                <div class="content-header">
                    <div>
                        <i class="fas fa-{{ $quiz->quiz_file ? 'file-download' : 'list-alt' }}"></i>
                        {{ $quiz->quiz_file ? 'Quiz File' : 'Quiz Questions' }}
                    </div>
                    @if(!$quiz->quiz_file && $quiz->questions->count() > 0)
                        <span class="badge badge-light">{{ $quiz->questions->count() }} Questions</span>
                    @endif
                </div>

                <div class="content-body">
                    @if($quiz->quiz_file)
                        <!-- File-based Quiz Display -->
                        <div class="file-preview">
                            <div class="file-icon">
                                @php
                                    $extension = strtolower(pathinfo($quiz->quiz_file, PATHINFO_EXTENSION));
                                    $iconClass = match($extension) {
                                        'pdf' => 'fas fa-file-pdf',
                                        'docx', 'doc' => 'fas fa-file-word',
                                        'xlsx', 'xls' => 'fas fa-file-excel',
                                        'csv' => 'fas fa-file-csv',
                                        'json' => 'fas fa-file-code',
                                        default => 'fas fa-file'
                                    };
                                @endphp
                                <i class="{{ $iconClass }}" style="color: {{ $extension === 'pdf' ? '#DC3545' : ($extension === 'docx' || $extension === 'doc' ? '#2B579A' : ($extension === 'xlsx' || $extension === 'xls' ? '#1D6F42' : '#667eea')) }};"></i>
                            </div>
                            <div class="file-info">
                                <h4>{{ $quiz->quiz_file }}</h4>
                                <p>This quiz is provided as a {{ strtoupper($extension) }} file. Students can view or download the file to access the quiz content.</p>
                                <div class="file-actions">
                                    @if(file_exists(public_path('storage/quizzes/' . $quiz->quiz_file)))
                                        <a href="{{ asset('storage/quizzes/' . $quiz->quiz_file) }}" target="_blank" class="btn-action btn-primary">
                                            <i class="fas fa-eye"></i> Preview File
                                        </a>
                                        <a href="{{ asset('storage/quizzes/' . $quiz->quiz_file) }}" download class="btn-action btn-success">
                                            <i class="fas fa-download"></i> Download File
                                        </a>
                                    @else
                                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> File not found on server</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Created Quiz Display -->
                        @if($quiz->questions->count() > 0)
                            @foreach($quiz->questions as $index => $question)
                                <div class="question-card">
                                    <div class="question-header">
                                        <div class="question-number">{{ $index + 1 }}</div>
                                        <div class="question-text">{{ $question->question_text }}</div>
                                    </div>

                                    <div class="options-container">
                                        <div class="option-item {{ $question->correct_option === 'option1' ? 'correct' : '' }}">
                                            <div class="option-label">A</div>
                                            <div class="option-text">{{ $question->option1 }}</div>
                                        </div>
                                        <div class="option-item {{ $question->correct_option === 'option2' ? 'correct' : '' }}">
                                            <div class="option-label">B</div>
                                            <div class="option-text">{{ $question->option2 }}</div>
                                        </div>
                                        <div class="option-item {{ $question->correct_option === 'option3' ? 'correct' : '' }}">
                                            <div class="option-label">C</div>
                                            <div class="option-text">{{ $question->option3 }}</div>
                                        </div>
                                        <div class="option-item {{ $question->correct_option === 'option4' ? 'correct' : '' }}">
                                            <div class="option-label">D</div>
                                            <div class="option-text">{{ $question->option4 }}</div>
                                        </div>
                                    </div>

                                    <div class="correct-indicator">
                                        <i class="fas fa-check-circle"></i>
                                        Correct Answer: {{ 
                                            $question->correct_option === 'option1' ? 'A' : 
                                            ($question->correct_option === 'option2' ? 'B' : 
                                            ($question->correct_option === 'option3' ? 'C' : 'D')) 
                                        }} - {{ $question->{$question->correct_option} }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="fas fa-question-circle"></i>
                                <h3>No Questions Added</h3>
                                <p>This quiz doesn't have any questions yet. You can edit the quiz to add questions.</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="btn-action btn-warning">
                    <i class="fas fa-edit"></i> Edit Quiz
                </a>
                <a href="{{ route('admin.quizzes.results', $quiz->id) }}" class="btn-action btn-info">
                    <i class="fas fa-chart-bar"></i> View Results
                </a>
                @if($quiz->quiz_file && file_exists(public_path('storage/quizzes/' . $quiz->quiz_file)))
                    <a href="{{ asset('storage/quizzes/' . $quiz->quiz_file) }}" target="_blank" class="btn-action btn-success">
                        <i class="fas fa-external-link-alt"></i> Open File
                    </a>
                @endif
                <button onclick="window.print()" class="btn-action btn-secondary">
                    <i class="fas fa-print"></i> Print View
                </button>
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

@endsection
