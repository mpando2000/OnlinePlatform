@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Promotion History</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Promotions
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Complete Promotion History</h5>
                        </div>
                        <div class="card-body">
                            @if ($promotionHistory->isEmpty())
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> No promotion history found.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>From Class</th>
                                                <th>To Class</th>
                                                <th>Academic Year</th>
                                                <th>Promoted At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($promotionHistory as $promotion)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.promotions.student-history', $promotion->student) }}"
                                                           class="text-decoration-none">
                                                            {{ $promotion->student->name }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $promotion->student->email }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            {{ $promotion->fromClass->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success">
                                                            {{ $promotion->toClass->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary">
                                                            {{ $promotion->from_academic_year }} → {{ $promotion->to_academic_year }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <small>{{ $promotion->promoted_at->format('M d, Y H:i:s') }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="{{ route('admin.promotions.student-history', $promotion->student) }}"
                                                               class="btn btn-info" title="View Full History">
                                                                <i class="fas fa-history"></i>
                                                            </a>
                                                            <form action="{{ route('admin.promotions.undo', $promotion) }}"
                                                                  method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Are you sure you want to undo this promotion? The student will be moved back to {{ $promotion->fromClass->name }} and academic year {{ $promotion->from_academic_year }}.')">
                                                                    <i class="fas fa-undo"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $promotionHistory->links() }}
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
@endsection
