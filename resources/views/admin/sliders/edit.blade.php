@extends('components.dashmaster')

@section('body')
<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-edit"></i> Edit Slider</h1>
                <p>Update slide image and caption.</p>
            </div>
            <a href="{{ route('admin.sliders.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Sliders</a>
        </div>
        @include('admin.sliders.partials.errors')
        <div class="form-card">
            @if($slider->image_path)
                @php($src = (str_starts_with($slider->image_path, 'images/') || str_starts_with($slider->image_path, 'public/')) ? asset($slider->image_path) : asset('storage/' . $slider->image_path))
                <img src="{{ $src }}" alt="Current slider" class="preview-image">
            @endif
            <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.sliders.partials.form', ['slider' => $slider, 'requireImage' => false])
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="{{ route('admin.sliders.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.sliders.partials.clean-styles')
@endsection
