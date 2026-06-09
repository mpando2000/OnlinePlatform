@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-user-graduate"></i> {{ $student->firstname }} {{ $student->lastname }}</h1>
                <p>Promotion history</p>
            </div>
            <a href="{{ route('admin.promotions.history') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> History</a>
        </div>
        @include('admin.student-promotions.partials.history-table', ['promotions' => $promotions])
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.student-promotions.partials.clean-styles')
@endsection
