@extends('components.dashmaster')

@section('body')
<style>
    .quiz-hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .quiz-stats-card {
        background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
        border: none;
        border-radius: 15px;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .quiz-stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }
    
    .quiz-info-card {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .quiz-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }
    
    .question-card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .question-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .question-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .option-item {
        padding: 10px 15px;
        border-left: 4px solid #f8f9fa;
        margin: 8px 0;
        border-radius: 5px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .option-item:hover {
        background: #e9ecef;
        border-left-color: #667eea;
    }
    
    .correct-answer {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        border-left-color: #4CAF50 !important;
    }
    
    .file-preview-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        border-radius: 15px;
        color: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .action-buttons {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-top: 2rem;
    }
    
    .modern-btn {
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 5px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-results {
        background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
        color: white;
    }
    
    .btn-results:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 126, 95, 0.4);
        color: white;
    }
    
    .btn-back {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #333;
    }
    
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(168, 237, 234, 0.4);
        color: #333;
    }
    
    .status-badge {
        font-size: 0.85rem;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
    }
    
    .status-active {
        background: #4CAF50;
        color: white;
    }
    
    .status-upcoming {
        background: #FF9800;
        color: white;
    }
    
    .status-ended {
        background: #f44336;
        color: white;
    }
    
    .no-questions-state {
        text-align: center;
        padding: 3rem;
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        border-radius: 15px;
        color: #666;
    }
    
    .quiz-metadata {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .metadata-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .metadata-item:last-child {
        border-bottom: none;
    }
    
    .metadata-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
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
    
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<div class="content-wrapper">
    <!-- Quiz Hero Section -->
    <div class="quiz-hero-section animate-fade-in">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 font-weight-bold mb-3">{{ $quiz->title }}</h1>
                    <p class="lead mb-3">{{ $quiz->description ?: 'No description provided.' }}</p>
                    @php
                        $now = now();
                        $startTime = \Carbon\Carbon::parse($quiz->start_time);
                        $endTime = \Carbon\Carbon::parse($quiz->end_time);
                        
                        if ($now->lt($startTime)) {
                            $status = 'upcoming';
                            $statusText = 'Upcoming';
                        } elseif ($now->between($startTime, $endTime)) {
                            $status = 'active';
                            $statusText = 'Active';
                        } else {
                            $status = 'ended';
                            $statusText = 'Ended';
                        }
                    @endphp
                    <span class="status-badge status-{{ $status }}">
                        <i class="fas fa-circle mr-1" style="font-size: 0.6rem;"></i>
                        {{ $statusText }}
                    </span>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="quiz-stats-card card p-4">
                        <h3 class="mb-0">{{ $quiz->questions->count() }}</h3>
                        <p class="mb-0">Total Questions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Quiz Metadata -->
        <div class="quiz-metadata animate-fade-in">
            <div class="row">
                <div class="col-md-6">
                    <div class="metadata-item">
                        <div class="metadata-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <strong>Class:</strong> {{ $quiz->class->name }}
                        </div>
                    </div>
                    <div class="metadata-item">
                        <div class="metadata-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <strong>Subject:</strong> {{ $quiz->subject->name }}
                        </div>
                    </div>
                    <div class="metadata-item">
                        <div class="metadata-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <strong>Duration:</strong> {{ $quiz->duration }} minutes
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metadata-item">
                        <div class="metadata-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <strong>Start Time:</strong> {{ \Carbon\Carbon::parse($quiz->start_time)->format('M d, Y - h:i A') }}
                        </div>
                    </div>
                    <div class="metadata-item">
                        <div class="metadata-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div>
                            <strong>End Time:</strong> {{ \Carbon\Carbon::parse($quiz->end_time)->format('M d, Y - h:i A') }}
                        </div>
                    </div>
                    <div class="metadata-item">
                        <div class="metadata-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <strong>Submissions:</strong> {{ $quiz->quiz_results ? $quiz->quiz_results->count() : 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($quiz->quiz_file)
            <!-- File-based Quiz -->
            <div class="card file-preview-card animate-fade-in">
                <div class="card-body text-center py-5">
                    <i class="fas fa-file-alt fa-5x mb-4" style="opacity: 0.8;"></i>
                    <h3 class="card-title">Quiz File Upload</h3>
                    <p class="card-text lead">This quiz was created from an uploaded file. Students can access the quiz content below.</p>
                    <div class="mt-4">
                        <a href="{{ $quiz->quiz_file_url }}" target="_blank" class="modern-btn btn-results">
                            <i class="fas fa-eye mr-2"></i>View Quiz File
                        </a>
                        <a href="{{ $quiz->quiz_file_url }}" download class="modern-btn btn-edit">
                            <i class="fas fa-download mr-2"></i>Download File
                        </a>
                    </div>
                    <div class="mt-3">
                        <small style="opacity: 0.8;">
                            <i class="fas fa-info-circle mr-1"></i>
                            File: {{ basename($quiz->quiz_file) }}
                        </small>
                    </div>
                </div>
            </div>
        @else
            <!-- Multiple-choice Quiz -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">
                            <i class="fas fa-question-circle text-primary mr-2"></i>
                            Quiz Questions
                        </h2>
                        @if($quiz->questions->count() > 0)
                            <span class="badge badge-primary badge-lg">{{ $quiz->questions->count() }} Questions</span>
                        @endif
                    </div>

                    @if($quiz->questions->count() > 0)
                        @foreach($quiz->questions as $index => $question)
                            <div class="question-card animate-fade-in" style="animation-delay: {{ $index * 0.1 }}s;">
                                <div class="question-header">
                                    <i class="fas fa-question mr-2"></i>
                                    Question {{ $index + 1 }}
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-4">{{ $question->question_text }}</h5>
                                    
                                    <div class="options-container">
                                        <h6 class="text-muted mb-3">
                                            <i class="fas fa-list mr-2"></i>Answer Options:
                                        </h6>
                                        <div class="row">
                                            @foreach(['option1', 'option2', 'option3', 'option4'] as $optionKey)
                                                <div class="col-md-6 mb-2">
                                                    <div class="option-item {{ $question->correct_option === $optionKey ? 'correct-answer' : '' }}">
                                                        <div class="d-flex align-items-center">
                                                            <span class="badge {{ $question->correct_option === $optionKey ? 'badge-light' : 'badge-secondary' }} mr-2">
                                                                {{ strtoupper(substr($optionKey, -1)) }}
                                                            </span>
                                                            <span class="flex-grow-1">{{ $question->{$optionKey} }}</span>
                                                            @if($question->correct_option === $optionKey)
                                                                <i class="fas fa-check-circle ml-2"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="mt-3 pt-3 border-top">
                                            <p class="mb-0">
                                                <i class="fas fa-bullseye text-success mr-2"></i>
                                                <strong>Correct Answer:</strong> 
                                                <span class="text-success font-weight-bold">
                                                    Option {{ strtoupper(substr($question->correct_option, -1)) }} - {{ $question->{$question->correct_option} }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-questions-state animate-fade-in">
                            <i class="fas fa-clipboard-question fa-5x mb-4" style="opacity: 0.5;"></i>
                            <h3>No Questions Added Yet</h3>
                            <p class="lead">This quiz doesn't have any questions. Add some questions to get started.</p>
                            <a href="{{ route('quizzes.edit', $quiz->id) }}" class="modern-btn btn-edit mt-3">
                                <i class="fas fa-plus mr-2"></i>Add Questions
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons animate-fade-in">
            <div class="text-center">
                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="modern-btn btn-edit">
                    <i class="fas fa-edit mr-2"></i>Edit Quiz
                </a>
                <a href="{{ route('view.quizzes.results', $quiz->id) }}" class="modern-btn btn-results">
                    <i class="fas fa-chart-bar mr-2"></i>View Results
                </a>
                <a href="{{ route('quizzes.index') }}" class="modern-btn btn-back">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Quizzes
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
document.addEventListener('DOMContentLoaded', function() {
    // Footer year update
    const yearElement = document.getElementById("currentYear");
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
    
    // Enhanced animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all question cards for scroll animations
    document.querySelectorAll('.question-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Quiz status countdown if upcoming
    const startTime = @json($quiz->start_time);
    const endTime = @json($quiz->end_time);
    const now = new Date();
    const start = new Date(startTime);
    const end = new Date(endTime);
    
    if (now < start) {
        // Quiz is upcoming - show countdown
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
    
    function updateCountdown() {
        const now = new Date();
        const start = new Date(startTime);
        const timeDiff = start - now;
        
        if (timeDiff > 0) {
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
            
            const countdownElement = document.querySelector('.status-upcoming');
            if (countdownElement) {
                countdownElement.innerHTML = `
                    <i class="fas fa-clock mr-1"></i>
                    Starts in: ${days}d ${hours}h ${minutes}m ${seconds}s
                `;
            }
        }
    }
    
    // Add click analytics for action buttons
    document.querySelectorAll('.modern-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Add subtle click feedback
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    
    // Tooltip initialization for better UX
    if (typeof $ !== 'undefined' && $.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip();
    }
    
    // Print functionality
    window.printQuiz = function() {
        const printContent = document.querySelector('.content-wrapper').innerHTML;
        const originalContent = document.body.innerHTML;
        
        document.body.innerHTML = `
            <div style="padding: 20px;">
                <h1>{{ $quiz->title }}</h1>
                <p><strong>Class:</strong> {{ $quiz->class->name }}</p>
                <p><strong>Subject:</strong> {{ $quiz->subject->name }}</p>
                <hr>
                ${printContent}
            </div>
        `;
        
        window.print();
        document.body.innerHTML = originalContent;
    };
});

// Add smooth scroll behavior for better navigation
document.documentElement.style.scrollBehavior = 'smooth';
</script>

@endsection
