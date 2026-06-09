@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-chart-line text-primary mr-2"></i>
                        Quiz Results
                    </h1>
                    <p class="text-muted mb-0">{{ $quizResult->quiz->title }}</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="result-summary">
                        @php
                            $percentage = $quizResult->percentage;
                            $resultClass = $percentage >= 80 ? 'excellent' : ($percentage >= 70 ? 'good' : ($percentage >= 60 ? 'average' : 'needs-improvement'));
                            $resultIcon = $percentage >= 80 ? 'trophy' : ($percentage >= 70 ? 'medal' : ($percentage >= 60 ? 'thumbs-up' : 'hand-paper'));
                            $resultColor = $percentage >= 80 ? 'success' : ($percentage >= 70 ? 'info' : ($percentage >= 60 ? 'warning' : 'danger'));
                        @endphp
                        <div class="result-badge badge-{{ $resultColor }}">
                            <i class="fas fa-{{ $resultIcon }} mr-1"></i>
                            {{ $percentage }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Results Section -->
                <div class="col-lg-8">
                    <!-- Score Overview -->
                    <div class="card result-card mb-4">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-pie mr-2"></i>
                                Score Overview
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="score-metric">
                                        <div class="score-circle {{ $resultClass }}">
                                            <div class="score-value">{{ $percentage }}%</div>
                                            <div class="score-label">Final Score</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="score-details">
                                        <h3 class="text-success">{{ $quizResult->score }}</h3>
                                        <p class="text-muted">Correct Answers</p>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" style="width: {{ ($quizResult->score / $quizResult->total_questions) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="score-details">
                                        <h3 class="text-danger">{{ $quizResult->total_questions - $quizResult->score }}</h3>
                                        <p class="text-muted">Incorrect Answers</p>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-danger" style="width: {{ (($quizResult->total_questions - $quizResult->score) / $quizResult->total_questions) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Gauge -->
                            <div class="performance-gauge mt-4">
                                <h6 class="text-center mb-3">Performance Level</h6>
                                <div class="gauge-container">
                                    <div class="gauge">
                                        <div class="gauge-fill" data-percentage="{{ $percentage }}"></div>
                                        <div class="gauge-labels">
                                            <span class="gauge-label poor">0%</span>
                                            <span class="gauge-label average">50%</span>
                                            <span class="gauge-label excellent">100%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    @if($percentage >= 80)
                                        <span class="badge badge-success badge-lg">
                                            <i class="fas fa-star mr-1"></i>Excellent Performance!
                                        </span>
                                    @elseif($percentage >= 70)
                                        <span class="badge badge-info badge-lg">
                                            <i class="fas fa-thumbs-up mr-1"></i>Good Work!
                                        </span>
                                    @elseif($percentage >= 60)
                                        <span class="badge badge-warning badge-lg">
                                            <i class="fas fa-hand-paper mr-1"></i>Average Performance
                                        </span>
                                    @else
                                        <span class="badge badge-danger badge-lg">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Needs Improvement
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Analysis -->
                    <div class="card result-card mb-4">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-analytics mr-2"></i>
                                Detailed Analysis
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="analysis-item">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-clock text-primary mr-2"></i>
                                            <span class="font-weight-bold">Time Taken</span>
                                        </div>
                                        <p class="text-muted mb-0">
                                            @if(isset($quizResult->time_taken))
                                                {{ gmdate('H:i:s', $quizResult->time_taken) }}
                                            @else
                                                Not recorded
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="analysis-item">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar text-success mr-2"></i>
                                            <span class="font-weight-bold">Completed On</span>
                                        </div>
                                        <p class="text-muted mb-0">{{ $quizResult->created_at->format('M d, Y \a\t H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="performance-breakdown">
                                <h6 class="mb-3">Performance Breakdown</h6>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <div class="metric-box correct">
                                            <div class="metric-icon">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="metric-value">{{ $quizResult->score }}</div>
                                            <div class="metric-label">Correct</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <div class="metric-box incorrect">
                                            <div class="metric-icon">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div class="metric-value">{{ $quizResult->total_questions - $quizResult->score }}</div>
                                            <div class="metric-label">Incorrect</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <div class="metric-box total">
                                            <div class="metric-icon">
                                                <i class="fas fa-question-circle"></i>
                                            </div>
                                            <div class="metric-value">{{ $quizResult->total_questions }}</div>
                                            <div class="metric-label">Total</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <div class="metric-box accuracy">
                                            <div class="metric-icon">
                                                <i class="fas fa-bullseye"></i>
                                            </div>
                                            <div class="metric-value">{{ $percentage }}%</div>
                                            <div class="metric-label">Accuracy</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Motivational Message -->
                    <div class="card result-card">
                        <div class="card-body text-center motivational-section">
                            @if($percentage >= 80)
                                <div class="motivation-icon text-success">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <h5 class="text-success">Outstanding Performance!</h5>
                                <p class="text-muted">You've demonstrated excellent understanding of the material. Keep up the great work!</p>
                            @elseif($percentage >= 70)
                                <div class="motivation-icon text-info">
                                    <i class="fas fa-medal"></i>
                                </div>
                                <h5 class="text-info">Well Done!</h5>
                                <p class="text-muted">You're doing great! With a little more practice, you'll reach excellence.</p>
                            @elseif($percentage >= 60)
                                <div class="motivation-icon text-warning">
                                    <i class="fas fa-thumbs-up"></i>
                                </div>
                                <h5 class="text-warning">Good Effort!</h5>
                                <p class="text-muted">You're on the right track. Review the material and try again to improve your score.</p>
                            @else
                                <div class="motivation-icon text-danger">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h5 class="text-danger">Keep Trying!</h5>
                                <p class="text-muted">Don't give up! Review the material carefully and practice more. You've got this!</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Actions Card -->
                    <div class="card result-card mb-4">
                        <div class="card-header bg-gradient-secondary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-cog mr-2"></i>
                                Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('student.quizzes') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-list mr-2"></i>
                                    Back to Quizzes
                                </a>
                                <button onclick="window.print()" class="btn btn-outline-secondary">
                                    <i class="fas fa-print mr-2"></i>
                                    Print Results
                                </button>
                                <button onclick="shareResults()" class="btn btn-outline-info">
                                    <i class="fas fa-share mr-2"></i>
                                    Share Results
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Information -->
                    <div class="card result-card mb-4">
                        <div class="card-header bg-gradient-dark text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle mr-2"></i>
                                Quiz Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="quiz-info">
                                <div class="info-item mb-3">
                                    <i class="fas fa-graduation-cap text-primary mr-2"></i>
                                    <div>
                                        <strong>Quiz Title</strong>
                                        <p class="mb-0 text-muted">{{ $quizResult->quiz->title }}</p>
                                    </div>
                                </div>
                                @if($quizResult->quiz->description)
                                    <div class="info-item mb-3">
                                        <i class="fas fa-align-left text-info mr-2"></i>
                                        <div>
                                            <strong>Description</strong>
                                            <p class="mb-0 text-muted">{{ Str::limit($quizResult->quiz->description, 100) }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="info-item mb-3">
                                    <i class="fas fa-question-circle text-success mr-2"></i>
                                    <div>
                                        <strong>Total Questions</strong>
                                        <p class="mb-0 text-muted">{{ $quizResult->total_questions }} questions</p>
                                    </div>
                                </div>
                                @if(isset($quizResult->quiz->duration))
                                    <div class="info-item">
                                        <i class="fas fa-hourglass-half text-warning mr-2"></i>
                                        <div>
                                            <strong>Duration</strong>
                                            <p class="mb-0 text-muted">{{ $quizResult->quiz->duration }} minutes</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Grade Scale -->
                    <div class="card result-card">
                        <div class="card-header bg-gradient-warning text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Grade Scale
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="grade-scale">
                                <div class="grade-item excellent {{ $percentage >= 80 ? 'active' : '' }}">
                                    <div class="grade-range">80% - 100%</div>
                                    <div class="grade-label">Excellent</div>
                                </div>
                                <div class="grade-item good {{ $percentage >= 70 && $percentage < 80 ? 'active' : '' }}">
                                    <div class="grade-range">70% - 79%</div>
                                    <div class="grade-label">Good</div>
                                </div>
                                <div class="grade-item average {{ $percentage >= 60 && $percentage < 70 ? 'active' : '' }}">
                                    <div class="grade-range">60% - 69%</div>
                                    <div class="grade-label">Average</div>
                                </div>
                                <div class="grade-item poor {{ $percentage < 60 ? 'active' : '' }}">
                                    <div class="grade-range">0% - 59%</div>
                                    <div class="grade-label">Needs Improvement</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<!-- Enhanced Quiz Results Styles -->
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecf4 100%);
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    /* Result Badge */
    .result-summary {
        text-align: center;
    }
    
    .result-badge {
        display: inline-block;
        font-size: 1.5rem;
        font-weight: bold;
        padding: 1rem 1.5rem;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        animation: badge-entrance 0.8s ease-out;
    }
    
    @keyframes badge-entrance {
        0% { transform: scale(0) rotate(180deg); opacity: 0; }
        50% { transform: scale(1.2) rotate(0deg); opacity: 0.8; }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    
    /* Result Cards */
    .result-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .result-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .result-card .card-header {
        border-radius: 15px 15px 0 0;
        font-weight: 600;
        border-bottom: none;
    }
    
    /* Score Circle */
    .score-metric {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
    }
    
    .score-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        background: conic-gradient(from 0deg, #e9ecef 0%, var(--circle-color) var(--circle-percent), #e9ecef var(--circle-percent));
        animation: score-reveal 2s ease-out 0.5s both;
    }
    
    .score-circle.excellent {
        --circle-color: #28a745;
        --circle-percent: {{ $percentage }}%;
        box-shadow: 0 0 30px rgba(40, 167, 69, 0.3);
    }
    
    .score-circle.good {
        --circle-color: #17a2b8;
        --circle-percent: {{ $percentage }}%;
        box-shadow: 0 0 30px rgba(23, 162, 184, 0.3);
    }
    
    .score-circle.average {
        --circle-color: #ffc107;
        --circle-percent: {{ $percentage }}%;
        box-shadow: 0 0 30px rgba(255, 193, 7, 0.3);
    }
    
    .score-circle.needs-improvement {
        --circle-color: #dc3545;
        --circle-percent: {{ $percentage }}%;
        box-shadow: 0 0 30px rgba(220, 53, 69, 0.3);
    }
    
    .score-circle::before {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 50%;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
    }
    
    .score-value {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--circle-color);
        z-index: 1;
        animation: number-count 2s ease-out 0.8s both;
    }
    
    .score-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
        z-index: 1;
    }
    
    @keyframes score-reveal {
        0% { 
            background: conic-gradient(from 0deg, #e9ecef 0%, #e9ecef 100%);
            transform: rotate(-90deg) scale(0.8);
        }
        100% { 
            background: conic-gradient(from 0deg, #e9ecef 0%, var(--circle-color) var(--circle-percent), #e9ecef var(--circle-percent));
            transform: rotate(-90deg) scale(1);
        }
    }
    
    @keyframes number-count {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    /* Score Details */
    .score-details {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .score-details:hover {
        background: #e9ecef;
        transform: scale(1.05);
    }
    
    .score-details h3 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    
    /* Performance Gauge */
    .performance-gauge {
        padding: 2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
    }
    
    .gauge-container {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
    }
    
    .gauge {
        width: 200px;
        height: 100px;
        position: relative;
        background: linear-gradient(90deg, #dc3545 0%, #ffc107 50%, #28a745 100%);
        border-radius: 100px 100px 0 0;
        overflow: hidden;
    }
    
    .gauge::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: #343a40;
        border-radius: 50%;
        z-index: 3;
    }
    
    .gauge-fill {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        transition: width 2s ease-out 1s;
        width: 0%;
    }
    
    .gauge-labels {
        position: absolute;
        bottom: -25px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    /* Metric Boxes */
    .performance-breakdown .row {
        gap: 0;
    }
    
    .metric-box {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        text-align: center;
        border: 2px solid;
        transition: all 0.3s ease;
        height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        animation: metric-bounce 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .metric-box.correct {
        border-color: #28a745;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        animation-delay: 0.2s;
    }
    
    .metric-box.incorrect {
        border-color: #dc3545;
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        animation-delay: 0.4s;
    }
    
    .metric-box.total {
        border-color: #17a2b8;
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        animation-delay: 0.6s;
    }
    
    .metric-box.accuracy {
        border-color: #6f42c1;
        background: linear-gradient(135deg, #e2d9f3 0%, #d7c4ed 100%);
        animation-delay: 0.8s;
    }
    
    .metric-box:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .metric-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        opacity: 0.8;
    }
    
    .metric-value {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 0.25rem;
    }
    
    .metric-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    @keyframes metric-bounce {
        0% { transform: scale(0) rotate(180deg); opacity: 0; }
        50% { transform: scale(1.2) rotate(0deg); opacity: 0.8; }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    
    /* Motivational Section */
    .motivational-section {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }
    
    .motivation-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        animation: motivation-bounce 2s ease-in-out infinite;
    }
    
    @keyframes motivation-bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    /* Quiz Information */
    .quiz-info .info-item {
        display: flex;
        align-items: flex-start;
        padding: 0.5rem 0;
    }
    
    .quiz-info .info-item i {
        margin-top: 0.25rem;
        flex-shrink: 0;
    }
    
    .quiz-info .info-item div {
        flex: 1;
        margin-left: 0.5rem;
    }
    
    /* Grade Scale */
    .grade-scale .grade-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        border-radius: 8px;
        background: #f8f9fa;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .grade-item.active {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-color: #007bff;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }
    
    .grade-range {
        font-weight: bold;
    }
    
    .grade-label {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    /* Button Enhancements */
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }
    
    /* Badge Enhancements */
    .badge-lg {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }
    
    /* Analysis Items */
    .analysis-item {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #007bff;
        transition: all 0.3s ease;
    }
    
    .analysis-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
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
    
    /* Staggered animations */
    .result-card:nth-child(1) { animation-delay: 0.1s; }
    .result-card:nth-child(2) { animation-delay: 0.2s; }
    .result-card:nth-child(3) { animation-delay: 0.3s; }
    .result-card:nth-child(4) { animation-delay: 0.4s; }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .result-badge {
            font-size: 1.2rem;
            padding: 0.75rem 1rem;
        }
        
        .score-circle {
            width: 120px;
            height: 120px;
        }
        
        .score-circle::before {
            width: 95px;
            height: 95px;
        }
        
        .score-value {
            font-size: 2rem;
        }
        
        .score-details {
            height: auto;
            margin-bottom: 1rem;
        }
        
        .metric-box {
            height: auto;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .motivation-icon {
            font-size: 3rem;
        }
        
        .gauge {
            width: 150px;
            height: 75px;
        }
    }
    
    /* Print Styles */
    @media print {
        .content-wrapper {
            background: white !important;
        }
        
        .result-card {
            box-shadow: none !important;
            border: 1px solid #dee2e6 !important;
            margin-bottom: 1rem !important;
        }
        
        .btn, .badge {
            color: #000 !important;
            background: transparent !important;
            border: 1px solid #000 !important;
        }
        
        .motivational-section {
            page-break-inside: avoid;
        }
    }
    
    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
</style>

<!-- Enhanced Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Footer year
        document.getElementById("currentYear").textContent = new Date().getFullYear();
        
        // Initialize gauge animation
        setTimeout(() => {
            const gaugeFill = document.querySelector('.gauge-fill');
            const percentage = {{ $percentage }};
            if (gaugeFill) {
                // Convert percentage to gauge width (0-100% maps to 0-100% of gauge)
                gaugeFill.style.width = `${100 - percentage}%`;
            }
        }, 1000);
        
        // Animate numbers counting up
        const animateNumber = (element, start, end, duration) => {
            const range = end - start;
            const increment = range / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= end) {
                    current = end;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 16);
        };
        
        // Animate metric values
        setTimeout(() => {
            const correctValue = document.querySelector('.metric-box.correct .metric-value');
            const incorrectValue = document.querySelector('.metric-box.incorrect .metric-value');
            const totalValue = document.querySelector('.metric-box.total .metric-value');
            const accuracyValue = document.querySelector('.metric-box.accuracy .metric-value');
            
            if (correctValue) animateNumber(correctValue, 0, {{ $quizResult->score }}, 1000);
            if (incorrectValue) animateNumber(incorrectValue, 0, {{ $quizResult->total_questions - $quizResult->score }}, 1000);
            if (totalValue) animateNumber(totalValue, 0, {{ $quizResult->total_questions }}, 1000);
            if (accuracyValue) {
                const accuracy = accuracyValue;
                let current = 0;
                const target = {{ $percentage }};
                const timer = setInterval(() => {
                    current += 2;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    accuracy.textContent = current + '%';
                }, 30);
            }
        }, 800);
        
        // Add celebration effect for excellent scores
        @if($percentage >= 80)
            setTimeout(() => {
                createCelebration();
            }, 2000);
        @endif
    });
    
    // Share results function
    function shareResults() {
        const shareData = {
            title: 'Quiz Results - {{ $quizResult->quiz->title }}',
            text: `I scored {{ $percentage }}% ({{ $quizResult->score }}/{{ $quizResult->total_questions }}) on the {{ $quizResult->quiz->title }} quiz!`,
            url: window.location.href
        };
        
        if (navigator.share) {
            navigator.share(shareData)
                .then(() => showToast('Results shared successfully!', 'success'))
                .catch((err) => console.log('Error sharing:', err));
        } else {
            // Fallback: copy to clipboard
            const text = `${shareData.text}\n${shareData.url}`;
            navigator.clipboard.writeText(text)
                .then(() => showToast('Results copied to clipboard!', 'success'))
                .catch(() => showToast('Could not copy results', 'error'));
        }
    }
    
    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} toast-notification`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        
        const iconMap = {
            'success': 'check-circle',
            'error': 'exclamation-triangle',
            'warning': 'exclamation-circle',
            'info': 'info-circle'
        };
        
        toast.innerHTML = `
            <i class="fas fa-${iconMap[type] || 'info-circle'} mr-2"></i>
            ${message}
            <button type="button" class="close ml-2" onclick="this.parentElement.remove()">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }
        }, 4000);
    }
    
    // Celebration effect for excellent scores
    function createCelebration() {
        const colors = ['#f39c12', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71'];
        const animationEnd = Date.now() + 3000;
        
        const randomInRange = (min, max) => Math.random() * (max - min) + min;
        
        const frame = () => {
            const timeLeft = animationEnd - Date.now();
            
            if (timeLeft <= 0) return;
            
            const particleCount = 50 * (timeLeft / 3000);
            
            for (let i = 0; i < 2; i++) {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: fixed;
                    width: 10px;
                    height: 10px;
                    background: ${colors[Math.floor(Math.random() * colors.length)]};
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    left: ${randomInRange(10, window.innerWidth - 10)}px;
                    top: ${randomInRange(10, window.innerHeight - 10)}px;
                    animation: celebration 3s linear forwards;
                `;
                
                document.body.appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentElement) {
                        particle.remove();
                    }
                }, 3000);
            }
            
            requestAnimationFrame(frame);
        };
        
        // Add celebration animation keyframes
        if (!document.querySelector('#celebration-styles')) {
            const style = document.createElement('style');
            style.id = 'celebration-styles';
            style.textContent = `
                @keyframes celebration {
                    0% { opacity: 1; transform: translateY(0) rotate(0deg) scale(1); }
                    100% { opacity: 0; transform: translateY(-100vh) rotate(720deg) scale(0); }
                }
                @keyframes slideInRight {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOutRight {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }
        
        frame();
    }
</script>


@endsection

