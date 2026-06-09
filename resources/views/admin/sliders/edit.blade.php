@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Slider</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Slider</h3>
                </div>

                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">Image</label>
                            @if($slider->image_path)
                                <div class="mb-3">
                                    @if(str_starts_with($slider->image_path, 'images/') || str_starts_with($slider->image_path, 'public/'))
                                        <img src="{{ asset($slider->image_path) }}" alt="Current Image" style="max-width: 300px; max-height: 300px; object-fit: cover;" class="img-thumbnail">
                                    @else
                                        <img src="{{ asset('storage/' . $slider->image_path) }}" alt="Current Image" style="max-width: 300px; max-height: 300px; object-fit: cover;" class="img-thumbnail">
                                    @endif
                                    <small class="d-block text-muted mt-2">Current image</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Leave empty to keep current image. Max file size: 2MB</small>
                        </div>

                        <div class="form-group">
                            <label for="caption">Caption <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('caption') is-invalid @enderror" id="caption" name="caption" rows="4" required placeholder="Enter slider caption">{{ $slider->caption }}</textarea>
                            @error('caption')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ $slider->order }}">
                            @error('order')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $slider->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
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
