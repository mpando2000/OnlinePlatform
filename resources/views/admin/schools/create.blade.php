@extends('components.dashmaster')

@section('body')
<style>
    .school-form-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .back-navigation {
        margin-bottom: 20px;
        animation: slideInLeft 0.6s ease;
    }
    
    .back-btn {
        background: white;
        color: #2c3e50;
        padding: 12px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }
    
    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: #2c3e50;
        text-decoration: none;
    }
    
    .content-header h1 {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .breadcrumb-item a {
        color: #28a745;
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: #20c997;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
    }
    
    .form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.8s ease;
    }
    
    .form-section {
        margin-bottom: 40px;
        position: relative;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 3px solid #28a745;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 10px;
        color: #28a745;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .form-label i {
        margin-right: 8px;
        color: #28a745;
    }
    
    .required {
        color: #e74c3c;
        margin-left: 3px;
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        background: white;
        transform: translateY(-2px);
    }
    
    .form-control.is-invalid {
        border-color: #e74c3c;
    }
    
    .error-message {
        color: #e74c3c;
        font-size: 0.9rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }
    
    .error-message i {
        margin-right: 5px;
        font-size: 0.8rem;
    }
    
    .status-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 10px;
    }
    
    .status-option {
        position: relative;
    }
    
    .status-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .status-card {
        background: #f8f9fa;
        border: 3px solid #e9ecef;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .status-card:hover {
        border-color: #28a745;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.1);
    }
    
    .status-option input[type="radio"]:checked + label .status-card {
        border-color: #28a745;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(40, 167, 69, 0.3);
    }
    
    .status-icon {
        font-size: 2rem;
        margin-bottom: 10px;
        color: #28a745;
    }
    
    .status-option input[type="radio"]:checked + label .status-icon {
        color: white;
    }
    
    .status-card h5 {
        font-weight: 700;
        margin-bottom: 5px;
        color: #2c3e50;
    }
    
    .status-option input[type="radio"]:checked + label .status-card h5 {
        color: white;
    }
    
    .status-card p {
        color: #7f8c8d;
        margin: 0;
        font-size: 0.9rem;
    }
    
    .status-option input[type="radio"]:checked + label .status-card p {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .action-buttons {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
        margin-top: 30px;
        border: 2px dashed #dee2e6;
    }
    
    .modern-btn {
        padding: 15px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 10px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
    }
    
    .modern-btn i {
        margin-right: 8px;
    }
    
    .btn-create {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }
    
    .btn-create:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(40, 167, 69, 0.4);
        color: white;
    }
    
    .btn-cancel {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
        text-decoration: none;
    }
    
    .btn-cancel:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<div class="content-wrapper school-form-container">
    <div class="container-fluid">
        <!-- Back Navigation -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New School</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.schools.index') }}">Schools</a></li>
                            <li class="breadcrumb-item active">Add New</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section> 

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="form-container">
                    <form action="{{ route('admin.schools.store') }}" method="POST">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Basic Information
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">
                                            <i class="fas fa-school"></i>
                                            School Name<span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               name="name" 
                                               id="name" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" 
                                               required
                                               placeholder="Enter school name">
                                        @error('name')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="code">
                                            <i class="fas fa-code"></i>
                                            School Code<span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               name="code" 
                                               id="code" 
                                               class="form-control @error('code') is-invalid @enderror" 
                                               value="{{ old('code') }}" 
                                               required
                                               placeholder="Enter unique school code">
                                        @error('code')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">
                                    <i class="fas fa-align-left"></i>
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" 
                                          placeholder="Provide a brief description of the school">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-address-book"></i>
                                Contact Information
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="address">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Address
                                </label>
                                <input type="text" 
                                       name="address" 
                                       id="address" 
                                       class="form-control @error('address') is-invalid @enderror" 
                                       value="{{ old('address') }}" 
                                       placeholder="Enter school address">
                                @error('address')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone">
                                            <i class="fas fa-phone"></i>
                                            Phone Number
                                        </label>
                                        <input type="text" 
                                               name="phone" 
                                               id="phone" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone') }}" 
                                               placeholder="Enter phone number">
                                        @error('phone')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            <i class="fas fa-envelope"></i>
                                            Email Address
                                        </label>
                                        <input type="email" 
                                               name="email" 
                                               id="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" 
                                               placeholder="Enter email address">
                                        @error('email')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-toggle-on"></i>
                                School Status
                            </div>
                            
                            <div class="status-selector">
                                <div class="status-option">
                                    <input type="radio" name="status" value="active" id="status_active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                    <label for="status_active">
                                        <div class="status-card">
                                            <i class="fas fa-check-circle status-icon"></i>
                                            <h5>Active</h5>
                                            <p>School is operational and accepting students</p>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="status-option">
                                    <input type="radio" name="status" value="inactive" id="status_inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                    <label for="status_inactive">
                                        <div class="status-card">
                                            <i class="fas fa-pause-circle status-icon"></i>
                                            <h5>Inactive</h5>
                                            <p>School is temporarily closed or suspended</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            @error('status')
                                <div class="error-message mt-2">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="submit" class="modern-btn btn-create">
                                <i class="fas fa-save"></i>
                                Create School
                            </button>
                            <a href="{{ route('admin.schools.index') }}" class="modern-btn btn-cancel">
                                <i class="fas fa-times"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
    
    // Auto-generate code from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const code = name.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '_')
            .substring(0, 20);
        document.getElementById('code').value = code;
    });
</script>

@endsection
