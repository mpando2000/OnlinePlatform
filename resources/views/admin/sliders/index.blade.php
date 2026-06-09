@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Sliders</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Manage Sliders</h3>
                    <div class="card-tools pull-right">
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Slider
                        </a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    @if($sliders->count() > 0)
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Image</th>
                                    <th>Caption</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sliders-container">
                                @foreach($sliders as $slider)
                                    <tr class="slider-item" data-id="{{ $slider->id }}">
                                        <td>
                                            <span class="badge badge-primary">{{ $slider->order }}</span>
                                        </td>
                                        <td>
                                            @if($slider->image_path)
                                                @if(str_starts_with($slider->image_path, 'images/') || str_starts_with($slider->image_path, 'public/'))
                                                    <img src="{{ asset($slider->image_path) }}" alt="Slider" style="max-width: 100px; max-height: 100px; object-fit: cover;" class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="Slider" style="max-width: 100px; max-height: 100px; object-fit: cover;" class="img-thumbnail">
                                                @endif
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($slider->caption, 50) }}</small>
                                        </td>
                                        <td>
                                            @if($slider->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No sliders found. <a href="{{ route('admin.sliders.create') }}">Create one now</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
      </div>
    </section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>

@endsection
