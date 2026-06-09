@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-clock text-primary mr-2"></i>
                        {{ $quiz->title }}
                    </h1>
                    <p class="text-muted mb-0">{{ $quiz->description }}</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div id="timer-container" class="timer-display">
                        <div class="timer-label">Time Remaining</div>
                        <div id="timer" class="timer-value">{{ str_pad(floor($quiz->duration), 2, '0', STR_PAD_LEFT) }}:00</div>
                        <div class="timer-progress">
                            <div id="timer-bar" class="timer-bar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <!-- Quiz Progress Bar -->
            @if(count($questions) > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="quiz-progress">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Progress</span>
                                    <span class="badge badge-info" id="progress-counter">0 / {{ count($questions) }}</span>
                                </div>
                                <div class="progress progress-lg">
                                    <div id="quiz-progress" class="progress-bar bg-info" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quiz Form -->
            <form id="quiz-form" action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        @if(count($questions) > 0)
                            <!-- Questions Section -->
                            @foreach($questions as $index => $question)
                            <div class="card question-card mb-4" data-question="{{ $index + 1 }}" style="animation-delay: {{ ($index * 0.1) }}s;">
                                <div class="card-header bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <span class="question-number">Question {{ $index + 1 }}</span>
                                            <span class="text-muted">of {{ count($questions) }}</span>
                                        </h5>
                                        <div class="question-status">
                                            <i class="fas fa-circle text-muted" id="status-{{ $question->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="question-text mb-4">
                                        <h6 class="font-weight-bold">{{ $question->question_text }}</h6>
                                    </div>
                                    <div class="options-container">
                                        @foreach(['option1', 'option2', 'option3', 'option4'] as $optionKey)
                                            @if($question->$optionKey)
                                                <div class="option-item mb-3">
                                                    <label class="option-label">
                                                        <input 
                                                            type="radio" 
                                                            name="answers[{{ $question->id }}]" 
                                                            value="{{ $optionKey }}" 
                                                            class="option-radio"
                                                            data-question-id="{{ $question->id }}"
                                                        >
                                                        <div class="option-content">
                                                            <div class="option-indicator">{{ chr(65 + array_search($optionKey, ['option1', 'option2', 'option3', 'option4'])) }}</div>
                                                            <div class="option-text">{{ $question->$optionKey }}</div>
                                                        </div>
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <!-- File-Based Quiz Section -->
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-file-download mr-2"></i>
                                        Quiz Materials
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($quiz->quiz_file)
                                        <div class="file-download-section text-center">
                                            <div class="file-icon mb-3">
                                                <i class="fas fa-file-pdf fa-4x text-danger"></i>
                                            </div>
                                            <h6 class="mb-3">Download Quiz File</h6>
                                            <p class="text-muted mb-4">
                                                Download the quiz file, complete it according to the instructions, 
                                                and submit your answers before the time expires.
                                            </p>
                                            <a href="{{ route('student.quizzes.file', $quiz->id) }}" 
                                               class="btn btn-primary btn-lg mb-3" 
                                               target="_blank">
                                                <i class="fas fa-download mr-2"></i>
                                                Download Quiz
                                            </a>
                                            <div class="alert alert-info mt-3">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                <strong>Instructions:</strong>
                                                <ul class="mt-2 mb-0 text-left">
                                                    <li>Download and open the quiz file</li>
                                                    <li>Complete all questions in the file</li>
                                                    <li>Click "Submit Quiz" when finished</li>
                                                    <li>Your teacher will review and grade your submission</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            No quiz file available. Please contact your teacher.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="sticky-sidebar">
                            <!-- Quiz Info -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Quiz Information</h6>
                                </div>
                                <div class="card-body">
                                    @if(count($questions) > 0)
                                        <div class="info-item mb-3">
                                            <i class="fas fa-question-circle text-info mr-2"></i>
                                            <strong>{{ count($questions) }}</strong> Questions
                                        </div>
                                        <div class="info-item mb-3">
                                            <i class="fas fa-chart-line text-success mr-2"></i>
                                            <strong id="answered-count">0</strong> Answered
                                        </div>
                                    @else
                                        <div class="info-item mb-3">
                                            <i class="fas fa-file text-info mr-2"></i>
                                            <strong>File-Based</strong> Quiz
                                        </div>
                                    @endif
                                    <div class="info-item mb-3">
                                        <i class="fas fa-clock text-warning mr-2"></i>
                                        <strong>{{ $quiz->duration }}</strong> Minutes
                                    </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-exclamation-triangle text-danger mr-2"></i>
                                        <strong id="unanswered-count">{{ count($questions) }}</strong> Remaining
                                    </div>
                                </div>
                            </div>

                            <!-- Question Navigator -->
                            @if(count($questions) > 0)
                            <div class="card mb-4">
                                <div class="card-header bg-secondary text-white">
                                    <h6 class="mb-0"><i class="fas fa-list mr-2"></i>Question Navigator</h6>
                                </div>
                                <div class="card-body">
                                    <div class="question-navigator">
                                        @foreach($questions as $index => $question)
                                            <button 
                                                type="button" 
                                                class="nav-question btn btn-outline-secondary btn-sm"
                                                data-question="{{ $index + 1 }}"
                                                data-question-id="{{ $question->id }}"
                                            >
                                                {{ $index + 1 }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Submit Section -->
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-paper-plane mr-2"></i>Submit Quiz</h6>
                                </div>
                                <div class="card-body text-center">
                                    <button type="button" id="submit-quiz" class="btn btn-success btn-lg btn-block">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Submit Quiz
                                    </button>
                                    @if(count($questions) > 0)
                                        <p class="text-muted mt-2 mb-0">
                                            <small><i class="fas fa-shield-alt mr-1"></i>Auto-saves every 30 seconds</small>
                                        </p>
                                    @else
                                        <p class="text-muted mt-2 mb-0">
                                            <small><i class="fas fa-info-circle mr-1"></i>Submit when you've completed the quiz</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Enhanced Quiz Styles -->
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecf4 100%);
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    /* Timer Display */
    .timer-display {
        background: linear-gradient(135deg, #dc3545, #bd2130);
        color: white;
        padding: 1rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        animation: pulse-timer 2s ease-in-out infinite alternate;
    }
    
    .timer-label {
        font-size: 0.8rem;
        opacity: 0.9;
        margin-bottom: 0.25rem;
    }
    
    .timer-value {
        font-size: 1.8rem;
        font-weight: bold;
        font-family: 'Courier New', monospace;
        margin-bottom: 0.5rem;
    }
    
    .timer-progress {
        background: rgba(255, 255, 255, 0.3);
        height: 4px;
        border-radius: 2px;
        overflow: hidden;
    }
    
    .timer-bar {
        background: white;
        height: 100%;
        width: 100%;
        transition: width 1s linear;
    }
    
    @keyframes pulse-timer {
        0% { box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); }
        100% { box-shadow: 0 6px 25px rgba(220, 53, 69, 0.5); }
    }
    
    .timer-warning {
        animation: blink-warning 1s ease-in-out infinite !important;
    }
    
    @keyframes blink-warning {
        0%, 50% { background: linear-gradient(135deg, #ffc107, #e0a800); }
        51%, 100% { background: linear-gradient(135deg, #dc3545, #bd2130); }
    }
    
    .timer-critical {
        animation: blink-critical 0.5s ease-in-out infinite !important;
    }
    
    @keyframes blink-critical {
        0%, 50% { background: linear-gradient(135deg, #dc3545, #bd2130); }
        51%, 100% { background: linear-gradient(135deg, #ff0000, #cc0000); }
    }
    
    /* Quiz Progress */
    .quiz-progress {
        margin-bottom: 0;
    }
    
    .progress-lg {
        height: 8px;
        border-radius: 10px;
    }
    
    /* Question Cards */
    .question-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
        opacity: 0;
    }
    
    .question-card.visible {
        opacity: 1;
    }
    
    .question-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }
    
    .question-card .card-header {
        border-radius: 15px 15px 0 0;
        border-bottom: 2px solid #e9ecef;
    }
    
    .question-number {
        font-weight: 600;
        color: #495057;
    }
    
    .question-status i {
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }
    
    .question-status .fa-circle {
        color: #dee2e6 !important;
    }
    
    .question-status .fa-check-circle {
        color: #28a745 !important;
        animation: checkmark-bounce 0.5s ease-out;
    }
    
    @keyframes checkmark-bounce {
        0% { transform: scale(0.8); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    .question-text h6 {
        color: #495057;
        line-height: 1.5;
        font-size: 1.1rem;
    }
    
    /* Option Styling */
    .options-container {
        margin-top: 1rem;
    }
    
    .option-item {
        margin-bottom: 0.75rem;
    }
    
    .option-label {
        display: flex;
        align-items: flex-start;
        cursor: pointer;
        padding: 0.75rem;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-bottom: 0;
        width: 100%;
    }
    
    .option-label:hover {
        background: #e3f2fd;
        border-color: #2196f3;
        transform: translateX(5px);
    }
    
    .option-radio {
        display: none;
    }
    
    .option-radio:checked + .option-content {
        color: #2196f3;
        font-weight: 500;
    }
    
    .option-radio:checked + .option-content .option-indicator {
        background: #2196f3;
        color: white;
        transform: scale(1.1);
    }
    
    .option-label:has(.option-radio:checked) {
        background: #e3f2fd;
        border-color: #2196f3;
        box-shadow: 0 3px 10px rgba(33, 150, 243, 0.3);
    }
    
    .option-content {
        display: flex;
        align-items: center;
        width: 100%;
        transition: all 0.3s ease;
    }
    
    .option-indicator {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #6c757d;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        margin-right: 0.75rem;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    
    .option-text {
        flex: 1;
        line-height: 1.4;
    }
    
    /* Sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 2rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
    }
    
    /* Question Navigator */
    .question-navigator {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .nav-question {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    
    .nav-question:hover {
        transform: scale(1.1);
    }
    
    .nav-question.answered {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        color: white !important;
    }
    
    .nav-question.current {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: white !important;
        animation: current-pulse 2s ease-in-out infinite;
    }
    
    @keyframes current-pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7); }
        50% { box-shadow: 0 0 0 10px rgba(0, 123, 255, 0); }
    }
    
    /* Submit Button */
    #submit-quiz {
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    #submit-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }
    
    #submit-quiz.loading {
        opacity: 0.8;
        pointer-events: none;
    }
    
    #submit-quiz.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s ease infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Auto-save indicator */
    .auto-save-indicator {
        position: fixed;
        top: 80px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1000;
    }
    
    .auto-save-indicator.show {
        opacity: 1;
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .timer-display {
            margin-top: 1rem;
        }
        
        .timer-value {
            font-size: 1.4rem;
        }
        
        .sticky-sidebar {
            position: relative;
            top: 0;
            margin-top: 2rem;
        }
        
        .question-navigator {
            justify-content: center;
        }
        
        .nav-question {
            width: 35px;
            height: 35px;
        }
    }
    
    /* Print Styles */
    @media print {
        .timer-display, .sticky-sidebar {
            display: none !important;
        }
        
        .question-card {
            break-inside: avoid;
            margin-bottom: 1rem;
        }
    }
</style>

<!-- Enhanced Quiz Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quiz variables
        const totalDuration = {{ $quiz->duration }} * 60; // in seconds
        let duration = totalDuration;
        const totalQuestions = {{ count($questions) }};
        const isQuestionBased = totalQuestions > 0;
        let answeredQuestions = 0;
        let autoSaveInterval;
        
        // DOM elements
        const timer = document.getElementById('timer');
        const timerBar = document.getElementById('timer-bar');
        const timerContainer = document.getElementById('timer-container');
        const progressBar = document.getElementById('quiz-progress');
        const progressCounter = document.getElementById('progress-counter');
        const answeredCount = document.getElementById('answered-count');
        const unansweredCount = document.getElementById('unanswered-count');
        const submitButton = document.getElementById('submit-quiz');
        const quizForm = document.getElementById('quiz-form');
        
        // Initialize animations
        setTimeout(() => {
            document.querySelectorAll('.question-card').forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('visible');
                }, index * 100);
            });
        }, 100);
        
        // Timer functionality
        function startCountdown() {
            const interval = setInterval(() => {
                const minutes = Math.floor(duration / 60);
                const seconds = duration % 60;
                
                timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                // Update progress bar
                const progressPercent = ((totalDuration - duration) / totalDuration) * 100;
                timerBar.style.width = `${100 - (duration / totalDuration) * 100}%`;
                
                // Timer warnings
                if (duration <= 300) { // 5 minutes
                    timerContainer.classList.add('timer-critical');
                } else if (duration <= 600) { // 10 minutes
                    timerContainer.classList.add('timer-warning');
                }
                
                // Time up
                if (duration <= 0) {
                    clearInterval(interval);
                    showTimeUpDialog();
                }
                
                duration--;
            }, 1000);
            
            return interval;
        }
        
        // Time up dialog
        function showTimeUpDialog() {
            const confirmed = confirm('⏰ Time is up!\n\nYour quiz will be submitted automatically with your current answers.');
            submitQuiz(true);
        }
        
        // Question interaction (only for question-based quizzes)
        if (isQuestionBased) {
            document.querySelectorAll('.option-radio').forEach(radio => {
                radio.addEventListener('change', function() {
                    const questionId = this.dataset.questionId;
                    updateQuestionStatus(questionId, true);
                updateProgress();
                autoSave();
                });
            });
            
            // Update question status
            function updateQuestionStatus(questionId, answered) {
            const statusIcon = document.getElementById(`status-${questionId}`);
            const navButton = document.querySelector(`[data-question-id="${questionId}"]`);
            
            if (answered) {
                statusIcon.className = 'fas fa-check-circle text-success';
                navButton?.classList.add('answered');
            } else {
                statusIcon.className = 'fas fa-circle text-muted';
                navButton?.classList.remove('answered');
            }
        }
        
        // Update progress
        function updateProgress() {
            answeredQuestions = document.querySelectorAll('.option-radio:checked').length;
            const progressPercent = (answeredQuestions / totalQuestions) * 100;
            
            progressBar.style.width = `${progressPercent}%`;
            progressCounter.textContent = `${answeredQuestions} / ${totalQuestions}`;
            answeredCount.textContent = answeredQuestions;
            unansweredCount.textContent = totalQuestions - answeredQuestions;
            
            // Update submit button
            if (answeredQuestions === totalQuestions) {
                submitButton.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Submit Complete Quiz';
                submitButton.classList.remove('btn-warning');
                submitButton.classList.add('btn-success');
            } else {
                submitButton.innerHTML = `<i class="fas fa-paper-plane mr-2"></i>Submit Quiz (${answeredQuestions}/${totalQuestions})`;
                submitButton.classList.add('btn-warning');
                submitButton.classList.remove('btn-success');
            }
        }
        
            // Question navigator
            document.querySelectorAll('.nav-question').forEach(button => {
                button.addEventListener('click', function() {
                    const questionNumber = this.dataset.question;
                    const targetCard = document.querySelector(`[data-question="${questionNumber}"]`);
                    
                    if (targetCard) {
                        targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        
                        // Highlight current question
                        document.querySelectorAll('.nav-question').forEach(btn => btn.classList.remove('current'));
                        this.classList.add('current');
                    }
                });
            });
        }
        
        // Auto-save functionality
        function autoSave() {
            const formData = new FormData(quizForm);
            const answers = {};
            
            formData.forEach((value, key) => {
                if (key.startsWith('answers[')) {
                    answers[key] = value;
                }
            });
            
            // Store in localStorage as backup
            localStorage.setItem(`quiz_${{{ $quiz->id }}}_answers`, JSON.stringify(answers));
            
            // Show save indicator
            showAutoSaveIndicator();
        }
        
        // Auto-save indicator
        function showAutoSaveIndicator() {
            let indicator = document.querySelector('.auto-save-indicator');
            
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.className = 'auto-save-indicator';
                indicator.innerHTML = '<i class="fas fa-save mr-1"></i>Auto-saved';
                document.body.appendChild(indicator);
            }
            
            indicator.classList.add('show');
            setTimeout(() => indicator.classList.remove('show'), 2000);
        }
        
        // Load saved answers
        function loadSavedAnswers() {
            const saved = localStorage.getItem(`quiz_${{{ $quiz->id }}}_answers`);
            if (saved) {
                const answers = JSON.parse(saved);
                Object.entries(answers).forEach(([key, value]) => {
                    const radio = document.querySelector(`input[name="${key}"][value="${value}"]`);
                    if (radio) {
                        radio.checked = true;
                        const questionId = radio.dataset.questionId;
                        updateQuestionStatus(questionId, true);
                    }
                });
                updateProgress();
            }
        }
        
        // Submit quiz
        function submitQuiz(forced = false) {
            if (isQuestionBased && !forced && answeredQuestions < totalQuestions) {
                const unanswered = totalQuestions - answeredQuestions;
                if (!confirm(`You have ${unanswered} unanswered questions.\n\nAre you sure you want to submit?`)) {
                    return;
                }
            } else if (!isQuestionBased && !forced) {
                if (!confirm('Are you sure you want to submit this quiz?')) {
                    return;
                }
            }
            
            submitButton.classList.add('loading');
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
            
            // Clear auto-save data
            localStorage.removeItem(`quiz_${{{ $quiz->id }}}_answers`);
            
            // Submit form
            quizForm.submit();
        }
        
        // Submit button event
        submitButton.addEventListener('click', () => submitQuiz());
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + Enter = Submit
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                submitQuiz();
            }
            
            // Number keys 1-4 for options (when focused on a question)
            if (['1', '2', '3', '4'].includes(e.key)) {
                const focusedCard = document.querySelector('.question-card:hover');
                if (focusedCard) {
                    const options = focusedCard.querySelectorAll('.option-radio');
                    const optionIndex = parseInt(e.key) - 1;
                    if (options[optionIndex]) {
                        options[optionIndex].checked = true;
                        options[optionIndex].dispatchEvent(new Event('change'));
                    }
                }
            }
        });
        
        // Prevent accidental page leave
        window.addEventListener('beforeunload', function(e) {
            if (answeredQuestions > 0) {
                const message = 'You have unsaved quiz progress. Are you sure you want to leave?';
                e.returnValue = message;
                return message;
            }
        });
        
        // Form submit handler
        quizForm.addEventListener('submit', function() {
            window.removeEventListener('beforeunload', arguments.callee);
        });
        
        // Initialize
        if (isQuestionBased) {
            loadSavedAnswers();
            updateProgress();
            // Auto-save every 30 seconds
            autoSaveInterval = setInterval(autoSave, 30000);
        }
        
        startCountdown();
        
        // Footer year
        document.getElementById("currentYear").textContent = new Date().getFullYear();
    });
</script>
@endsection
