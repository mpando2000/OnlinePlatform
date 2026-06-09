@extends('components.dashmaster')

@section('body')
<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-plus"></i> Add Slider</h1>
                <p>Create a home page slide.</p>
            </div>
            <a href="{{ route('admin.sliders.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Sliders</a>
        </div>
        @include('admin.sliders.partials.errors')
        <div class="form-card">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.sliders.partials.form', ['slider' => null, 'requireImage' => true])
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Slider</button>
                    <a href="{{ route('admin.sliders.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.sliders.partials.clean-styles')
@endsection
