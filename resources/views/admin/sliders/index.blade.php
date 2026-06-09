@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-images"></i> Sliders</h1>
                <p>Manage images shown on the home page.</p>
            </div>
            <a href="{{ route('admin.sliders.create') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Add Slider</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-card">
            <div class="table-title">
                <strong>Slider List</strong>
                <span>{{ $sliders->count() }} sliders</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Caption</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    @if($slider->image_path)
                                        @php($src = (str_starts_with($slider->image_path, 'images/') || str_starts_with($slider->image_path, 'public/')) ? asset($slider->image_path) : asset('storage/' . $slider->image_path))
                                        <img src="{{ $src }}" alt="Slider" class="thumb">
                                    @else
                                        <span class="muted">No image</span>
                                    @endif
                                </td>
                                <td><strong>{{ Str::limit($slider->caption, 90) }}</strong></td>
                                <td>{{ $slider->order }}</td>
                                <td><span class="status-pill {{ $slider->is_active ? 'status-active' : 'status-inactive' }}">{{ $slider->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Delete this slider?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn danger" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-cell">No sliders found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.sliders.partials.clean-styles')
@endsection
