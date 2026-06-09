@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Promotion History for {{ $student->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <p class="text-muted">Email: {{ $student->email }}</p>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-12">
                    <a href="{{ route('admin.promotions.history') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to History
                    </a>
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Back to Promotions
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Current Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Current Class</h6>
                                    <p class="h5">
                                        <span class="badge bg-success">
                                            {{ $student->schoolClass->name ?? 'No Class Assigned' }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Academic Year</h6>
                                    <p class="h5">
                                        <span class="badge bg-info">{{ $student->academic_year }}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Total Promotions</h6>
                                    <p class="h5">
                                        <span class="badge bg-warning text-dark">{{ $promotions->count() }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Promotion Records</h5>
                        </div>
                        <div class="card-body">
                            @if ($promotions->isEmpty())
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> No promotion history found for this student.
                                </div>
                            @else
                                <div class="timeline">
                                    @foreach ($promotions as $promotion)
                                        <div class="timeline-item mb-4">
                                            <div class="timeline-marker {{ $loop->first ? 'active' : '' }}">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <h6 class="card-title mb-3">
                                                                    Promotion #{{ $loop->count - $loop->index + 1 }}
                                                                    @if ($loop->first)
                                                                        <span class="badge bg-success ms-2">Latest</span>
                                                                    @endif
                                                                </h6>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="mb-2">
                                                                            <strong>From:</strong>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge bg-secondary">
                                                                                {{ $promotion->fromClass->name }}
                                                                            </span>
                                                                        </p>
                                                                        <p class="text-muted small">
                                                                            Year: {{ $promotion->from_academic_year }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="mb-2">
                                                                            <strong>To:</strong>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge bg-success">
                                                                                {{ $promotion->toClass->name }}
                                                                            </span>
                                                                        </p>
                                                                        <p class="text-muted small">
                                                                            Year: {{ $promotion->to_academic_year }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p class="mb-2">
                                                                    <strong>Promoted At:</strong>
                                                                </p>
                                                                <p class="text-muted">
                                                                    {{ $promotion->promoted_at->format('M d, Y') }}
                                                                </p>
                                                                <p class="text-muted small">
                                                                    {{ $promotion->promoted_at->format('H:i:s') }}
                                                                </p>
                                                                @if ($loop->first)
                                                                    <form action="{{ route('admin.promotions.undo', $promotion) }}"
                                                                          method="POST" style="margin-top: 10px;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger w-100"
                                                                                onclick="return confirm('Are you sure you want to undo this promotion?')">
                                                                            <i class="fas fa-undo"></i> Undo
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<script>
    // footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>

<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        display: flex;
        position: relative;
        padding-left: 60px;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        top: 0;
        width: 40px;
        height: 40px;
        background-color: #0d6efd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .timeline-marker.active {
        background-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2), 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-item:not(:last-child) .timeline-marker::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 40px;
        width: 2px;
        height: 40px;
        background-color: #dee2e6;
        transform: translateX(-50%);
    }
</style>
@endsection
