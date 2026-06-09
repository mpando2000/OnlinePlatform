@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-history"></i> Promotion History</h1>
                <p>Recent student class changes.</p>
            </div>
            <a href="{{ route('admin.promotions.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Promotions</a>
        </div>
        @include('admin.student-promotions.partials.history-table', ['promotions' => $promotionHistory])
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.student-promotions.partials.clean-styles')
@endsection
