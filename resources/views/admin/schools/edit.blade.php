@extends('components.dashmaster')

@section('body')
<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-edit"></i> Edit School</h1>
                <p>{{ $school->name }}</p>
            </div>
            <a href="{{ route('admin.schools.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Schools</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('admin.schools.update', $school) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.schools.partials.form', ['school' => $school])
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="{{ route('admin.schools.show', $school) }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.schools.partials.form-styles')
@endsection
